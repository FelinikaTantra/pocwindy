@extends('layouts.admin')

@section('title', 'Page Builder: ' . $page->title)

@push('styles')
<style>
    .ghost { opacity: 0.4; background-color: #f3f4f6; border: 2px dashed #9ca3af; }
    .chosen { background-color: #e5e7eb; }
    .drag-handle { cursor: grab; }
    .drag-handle:active { cursor: grabbing; }
</style>
@endpush

@section('content')
<div class="mb-6 flex justify-between items-center">
    <a href="{{ route('admin.pages.index') }}" class="text-gray-500 hover:text-gray-700">
        <i class="fas fa-arrow-left mr-1"></i> Back to Pages
    </a>
    <a href="/{{ $page->slug }}" target="_blank" class="text-blue-600 hover:underline">
        <i class="fas fa-external-link-alt mr-1"></i> View Page
    </a>
</div>

<div x-data="pageBuilder()" class="grid grid-cols-1 lg:grid-cols-4 gap-6">
    <!-- Sidebar: Available Blocks -->
    <div class="lg:col-span-1 bg-white rounded-xl shadow-sm border border-gray-100 p-4 h-fit sticky top-6">
        <h3 class="font-bold text-gray-800 mb-4 border-b pb-2">Available Blocks</h3>
        <div class="space-y-2">
            <template x-for="type in availableTypes" :key="type.id">
                <button @click="addBlock(type.id)" class="w-full text-left px-4 py-3 border rounded-lg hover:bg-gray-50 transition flex items-center justify-between group">
                    <span x-text="type.name" class="font-medium text-sm text-gray-700"></span>
                    <i class="fas fa-plus text-gray-400 group-hover:text-blue-500"></i>
                </button>
            </template>
        </div>
    </div>

    <!-- Main: Drag & Drop Area -->
    <div class="lg:col-span-3">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 min-h-[500px]">
            <div class="flex justify-between items-center mb-4 border-b pb-4">
                <h2 class="text-2xl font-bold text-gray-800">Layout Builder</h2>
                <button @click="saveLayout()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded font-bold shadow transition flex items-center">
                    <i class="fas fa-save mr-2"></i> <span x-text="isSaving ? 'Saving...' : 'Save Layout'"></span>
                </button>
            </div>

            <div x-show="blocks.length === 0" class="text-center py-12 text-gray-500 border-2 border-dashed rounded-lg">
                <i class="fas fa-layer-group text-4xl mb-3 text-gray-300"></i>
                <p>No blocks added yet. Click a block on the left to add it.</p>
            </div>

            <div id="sortable-list" class="space-y-4">
                <template x-for="(block, index) in blocks" :key="block.id">
                    <div class="border rounded-lg bg-gray-50 flex flex-col relative" :data-id="block.id">
                        <div class="flex justify-between items-center p-3 bg-white border-b rounded-t-lg drag-handle">
                            <div class="font-bold text-gray-700 flex items-center">
                                <i class="fas fa-grip-lines text-gray-400 mr-3"></i>
                                <span x-text="getBlockName(block.type)"></span>
                            </div>
                            <button @click.prevent="removeBlock(index)" class="text-red-500 hover:text-red-700">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="p-4 space-y-3">
                            <!-- Dynamic Settings based on Block Type -->
                            <template x-if="block.type === 'hero'">
                                <div class="space-y-3">
                                    <input type="text" x-model="block.settings.headline" placeholder="Headline" class="w-full border rounded px-3 py-2 text-sm">
                                    <textarea x-model="block.settings.subheadline" placeholder="Subheadline" class="w-full border rounded px-3 py-2 text-sm"></textarea>
                                    <input type="text" x-model="block.settings.image_url" placeholder="Background Image URL" class="w-full border rounded px-3 py-2 text-sm">
                                </div>
                            </template>
                            <template x-if="block.type === 'product_grid'">
                                <div class="space-y-3">
                                    <input type="text" x-model="block.settings.title" placeholder="Section Title" class="w-full border rounded px-3 py-2 text-sm">
                                    <input type="number" x-model="block.settings.limit" placeholder="Number of Products to show" class="w-full border rounded px-3 py-2 text-sm">
                                </div>
                            </template>
                            <template x-if="block.type === 'text'">
                                <div class="space-y-3">
                                    <textarea x-model="block.settings.content" placeholder="Content" class="w-full border rounded px-3 py-2 text-sm h-24"></textarea>
                                </div>
                            </template>
                        </div>
                    </div>
                </template>
            </div>
            
            <div x-show="message" x-text="message" class="mt-4 p-3 bg-blue-50 text-blue-700 rounded text-sm text-center font-medium transition" x-transition></div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('pageBuilder', () => ({
            availableTypes: [
                { id: 'hero', name: 'Hero Section' },
                { id: 'product_grid', name: 'Product Grid' },
                { id: 'text', name: 'Text / Markdown' }
            ],
            blocks: @json($page->blocks->map(fn($b) => ['id' => uniqid(), 'type' => $b->type, 'settings' => (object)$b->settings])),
            isSaving: false,
            message: '',

            init() {
                let el = document.getElementById('sortable-list');
                Sortable.create(el, {
                    handle: '.drag-handle',
                    animation: 150,
                    ghostClass: 'ghost',
                    chosenClass: 'chosen',
                    onEnd: (evt) => {
                        const itemEl = this.blocks.splice(evt.oldIndex, 1)[0];
                        this.blocks.splice(evt.newIndex, 0, itemEl);
                    }
                });
            },

            addBlock(type) {
                this.blocks.push({
                    id: Date.now().toString(),
                    type: type,
                    settings: {}
                });
            },

            removeBlock(index) {
                if(confirm('Remove this block?')) {
                    this.blocks.splice(index, 1);
                }
            },

            getBlockName(typeId) {
                const type = this.availableTypes.find(t => t.id === typeId);
                return type ? type.name : typeId;
            },

            saveLayout() {
                this.isSaving = true;
                this.message = '';
                
                fetch("{{ route('admin.pages.blocks.save', $page) }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ blocks: this.blocks })
                })
                .then(res => res.json())
                .then(data => {
                    this.isSaving = false;
                    this.message = 'Layout saved successfully!';
                    setTimeout(() => this.message = '', 3000);
                })
                .catch(err => {
                    this.isSaving = false;
                    this.message = 'Error saving layout.';
                    console.error(err);
                });
            }
        }));
    });
</script>
@endpush
