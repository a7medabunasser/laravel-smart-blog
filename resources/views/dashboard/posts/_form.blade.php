<form action="{{ $action ?? route('dashboard.posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method($method ?? 'POST')

    <main class="pt-24 pb-32 flex flex-col md:flex-row max-w-container-max mx-auto px-gutter gap-12">

        <!-- Editor Canvas -->
        <div class="flex-1 max-w-article-max mx-auto w-full distraction-free-focus">
            <div class="editor-container">
                <!-- Title Field -->
                <input type="text" name="title" value="{{ old('title', $post->title) }}"
                    class="w-full bg-transparent border-none focus:ring-0 font-display-lg text-display-lg resize-none placeholder:text-surface-variant text-on-surface mb-8 overflow-hidden"
                    placeholder="Enter your title...">
                <!-- Floating Toolbar (Contextual) -->
                {{--
                <div class="sticky top-20 z-40 flex justify-center mb-12">
                    <div
                        class="bg-inverse-surface text-inverse-on-surface px-2 py-1.5 rounded-xl shadow-xl flex items-center gap-1 border border-outline/20">
                        <button class="p-2 hover:bg-white/10 rounded-lg transition-colors" title="Bold">
                            <span class="material-symbols-outlined">format_bold</span>
                        </button>
                        <button class="p-2 hover:bg-white/10 rounded-lg transition-colors" title="Italic">
                            <span class="material-symbols-outlined">format_italic</span>
                        </button>
                        <div class="w-px h-6 bg-white/10 mx-1"></div>
                        <button class="p-2 hover:bg-white/10 rounded-lg transition-colors" title="Heading 1">
                            <span class="material-symbols-outlined">format_h1</span>
                        </button>
                        <button class="p-2 hover:bg-white/10 rounded-lg transition-colors" title="Heading 2">
                            <span class="material-symbols-outlined">format_h2</span>
                        </button>
                        <div class="w-px h-6 bg-white/10 mx-1"></div>
                        <button class="p-2 hover:bg-white/10 rounded-lg transition-colors" title="Quote">
                            <span class="material-symbols-outlined">format_quote</span>
                        </button>
                        <button class="p-2 hover:bg-white/10 rounded-lg transition-colors" title="Link">
                            <span class="material-symbols-outlined">link</span>
                        </button>
                        <div class="w-px h-6 bg-white/10 mx-1"></div>
                        <button class="p-2 hover:bg-white/10 rounded-lg transition-colors" title="Image">
                            <span class="material-symbols-outlined">image</span>
                        </button>
                    </div>
                </div>
                <!-- Main Content Editor -->
                <div class="w-full min-h-[614px] bg-transparent border-none focus:outline-none font-body-lg text-body-lg text-on-surface leading-relaxed placeholder:text-surface-variant"
                    contenteditable="true" data-placeholder="Type your story...">
                    <p class="mb-6">It began as a simple thought—a flicker of ink on a pristine digital canvas. The
                        rhythm of the keys creates a cadence, a quiet symphony of creation that exists only between the
                        writer and the paper.</p>
                    <p class="mb-6">In this space, distraction falls away. The borders of the interface recede, leaving
                        only the words. We prioritize clarity above all else, ensuring that every sentence has room to
                        breathe and every idea has the weight it deserves.</p>
                </div>
                --}}
                <textarea name="content"
                    class="w-full bg-transparent border-none focus:ring-0 font-body-lg text-body-lg text-on-surface leading-relaxed placeholder:text-surface-variant"
                    data-placeholder="Type your story..." oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'>{{ old('content', $post->content) }}</textarea>
            </div>
            <button type="submit"
                class="bg-primary text-on-primary px-6 py-3 rounded-lg font-ui-label text-ui-label hover:bg-primary-hover transition-colors">
                {{ $type ?? 'Publish' }}
            </button>
        </div>
        <!-- Sidebar: Publishing Settings -->
        <aside
            class="hidden lg:block w-80 shrink-0 h-fit sticky top-24 sidebar-overlay transition-opacity duration-500">
            <div class="space-y-8 border-l border-outline-variant pl-8">
                <!-- Cover Image -->
                <section>
                    <h3 class="font-ui-label text-ui-label text-on-surface mb-4 uppercase tracking-wider">Cover Image
                    </h3>
                    <label for="cover" class="block cursor-pointer">
                        <div id="cover-preview-box"
                            class="aspect-video w-full rounded-lg bg-cover bg-center border-2 border-dashed border-outline-variant flex flex-col items-center justify-center gap-2 hover:bg-surface-container-high transition-colors group relative overflow-hidden"
                            style="background-image: url('{{ $post->cover_image ? asset('storage/' . $post->cover_image) : '' }}')">

                            <!-- Overlay and icon -->
                            <div id="cover-placeholder"
                                class="flex flex-col items-center justify-center gap-2 {{ $post->cover_image ? 'hidden group-hover:flex absolute inset-0 bg-black/40 text-white w-full h-full' : '' }}">
                                <span
                                    class="material-symbols-outlined text-secondary group-hover:text-primary transition-colors {{ $post->cover_image ? 'text-white group-hover:text-white' : '' }}">add_a_photo</span>
                                <span
                                    class="font-metadata text-metadata text-secondary {{ $post->cover_image ? 'text-white' : '' }}">
                                    {{ $post->cover_image ? 'Change cover photo' : 'Upload cover photo' }}
                                </span>
                            </div>
                        </div>
                    </label>
                    <input type="file" id="cover" name="cover" class="hidden" accept="image/png,image/jpeg"
                        onchange="previewCover(this)" />
                </section>
                <!-- Tags -->
                <section>
                    <h3 class="font-ui-label text-ui-label text-on-surface mb-4 uppercase tracking-wider">Tags</h3>
                    <div id="tag-preview-container" class="flex flex-wrap gap-2 mb-3">
                        @foreach ($post->tags as $tag)
                            <span
                                class="tag-badge bg-primary-fixed text-on-primary-fixed px-3 py-1 rounded-full font-metadata text-metadata flex items-center gap-1">
                                <span>{{ $tag->name }}</span>
                                <span class="material-symbols-outlined text-[14px] cursor-pointer tag-close-btn">
                                    close
                                </span>
                            </span>
                        @endforeach
                    </div>
                    <div class="relative">
                        <input id="tag-text-input" name="tags"
                            value="{{ old('tags', $post->exists ? $post->tags->pluck('name')->implode(', ') : '') }}"
                            class="w-full bg-white border border-outline-variant rounded-lg px-4 py-2 font-metadata text-metadata focus:ring-1 focus:ring-primary focus:border-primary transition-all"
                            placeholder="Add tag..." type="text" autocomplete="off" />
                    </div>
                </section>
                 <!-- Status -->
                <section class="pt-4 border-t border-outline-variant">
                    <label for="status" class="block mb-2 font-ui-label text-ui-label text-on-surface uppercase tracking-wider">
                        Status
                    </label>
                    
                    <div class="relative">
                        <select id="status" name="status"
                            class="w-full rounded-lg border border-outline-variant bg-white px-4 py-2.5 pr-10 font-metadata text-metadata text-on-surface transition-all duration-200 ease-in-out appearance-none cursor-pointer focus:border-primary focus:ring-1 focus:ring-primary">
                    
                            @foreach ($status_options as $status)
                                <option value="{{ $status->value }}" @selected(old('status', $post->status?->value) == $status->value) class="rounded-xl">
                                    {{ $status->getLabel() }}
                                </option>
                            @endforeach
                        </select>
                    
                        <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-secondary">
                            <span class="material-symbols-outlined text-[20px]">
                                expand_more
                            </span>
                        </span>
                    </div>
                </section>
            </div>
        </aside>

    </main>
</form>

@push('scripts')
    <script src="{{ asset('assets/preview.js') }}"></script>
@endpush
