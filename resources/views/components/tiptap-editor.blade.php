<div class="tiptap-editor-wrapper">
    <input type="hidden" id="content" name="content" value="{{ $content }}">
    
    <div id="tiptap-toolbar" class="tiptap-toolbar"></div>

    <div id="tiptap-editor" class="tiptap-content"></div>

    <input type="file" id="tiptap-image-upload" style="display: none;" accept="image/*">
</div>

<style>
    .tiptap-editor-wrapper { border: 1px solid #dee2e6; border-radius: 6px; }
    .tiptap-toolbar { display: flex; flex-wrap: wrap; padding: 8px; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa; }
    .tiptap-toolbar button { background: none; border: none; padding: 6px; margin: 2px; border-radius: 4px; cursor: pointer; }
    .tiptap-toolbar button:hover { background-color: #e2e6ea; }
    .tiptap-toolbar button.is-active { background-color: #0d6efd; color: white; }
    .tiptap-content .ProseMirror { padding: 15px; min-height: 300px; }
    .tiptap-content .ProseMirror:focus { outline: none; }
    .tiptap-content h1 { font-size: 2em; } .tiptap-content h2 { font-size: 1.5em; } .tiptap-content h3 { font-size: 1.25em; }
    .tiptap-content blockquote { border-left: 3px solid #ccc; margin-left: 1rem; padding-left: 1rem; }
    .tiptap-content img { max-width: 100%; height: auto; }
    .tiptap-content table { width: 100%; border-collapse: collapse; }
    .tiptap-content th, .tiptap-content td { border: 1px solid #ccc; padding: 8px; }
    .tiptap-content th { background-color: #f2f2f2; }
</style>

<script type="module">
    // CORRECTED: Changed Tiptap extensions to use named imports with {}
    import { Editor } from 'https://esm.sh/@tiptap/core';
    import StarterKit from 'https://esm.sh/@tiptap/starter-kit';
    import { Image } from 'https://esm.sh/@tiptap/extension-image';
    import { Link } from 'https://esm.sh/@tiptap/extension-link';
    import { TextAlign } from 'https://esm.sh/@tiptap/extension-text-align';
    import { Table } from 'https://esm.sh/@tiptap/extension-table';
    import { TableRow } from 'https://esm.sh/@tiptap/extension-table-row';
    import { TableCell } from 'https://esm.sh/@tiptap/extension-table-cell';
    import { TableHeader } from 'https://esm.sh/@tiptap/extension-table-header';
    import { Underline } from 'https://esm.sh/@tiptap/extension-underline';
    import { Highlight } from 'https://esm.sh/@tiptap/extension-highlight';
    
    // Get the hidden input and the initial content
    const hiddenInput = document.getElementById('content');
    const initialContent = hiddenInput.value;

    // --- SETUP THE EDITOR ---
    const editor = new Editor({
        element: document.querySelector('#tiptap-editor'),
        extensions: [
            StarterKit,
            Underline,
            TextAlign.configure({ types: ['heading', 'paragraph'] }),
            Image,
            Link.configure({ openOnClick: false }),
            Table.configure({ resizable: true }),
            TableRow, TableHeader, TableCell,
            Highlight.configure({ multicolor: true }),
        ],
        content: initialContent,
        onUpdate: ({ editor }) => {
            // On every update, save the HTML to the hidden input
            hiddenInput.value = editor.getHTML();
        },
    });

    // --- SETUP THE TOOLBAR ---
    const toolbar = document.getElementById('tiptap-toolbar');
    const fileInput = document.getElementById('tiptap-image-upload');

    // Define toolbar buttons
    const buttons = {
        bold: { icon: 'fas fa-bold', action: () => editor.chain().focus().toggleBold().run() },
        italic: { icon: 'fas fa-italic', action: () => editor.chain().focus().toggleItalic().run() },
        underline: { icon: 'fas fa-underline', action: () => editor.chain().focus().toggleUnderline().run() },
        strike: { icon: 'fas fa-strikethrough', action: () => editor.chain().focus().toggleStrike().run() },
        h1: { icon: 'fas fa-heading', text: '1', action: () => editor.chain().focus().toggleHeading({ level: 1 }).run() },
        h2: { icon: 'fas fa-heading', text: '2', action: () => editor.chain().focus().toggleHeading({ level: 2 }).run() },
        h3: { icon: 'fas fa-heading', text: '3', action: () => editor.chain().focus().toggleHeading({ level: 3 }).run() },
        bulletList: { icon: 'fas fa-list-ul', action: () => editor.chain().focus().toggleBulletList().run() },
        orderedList: { icon: 'fas fa-list-ol', action: () => editor.chain().focus().toggleOrderedList().run() },
        blockquote: { icon: 'fas fa-quote-right', action: () => editor.chain().focus().toggleBlockquote().run() },
        image: { icon: 'fas fa-image', action: () => fileInput.click() },
        table: { icon: 'fas fa-table', action: () => editor.chain().focus().insertTable({ rows: 3, cols: 3, withHeaderRow: true }).run() },
    };

    // Create and append buttons to the toolbar
    for (const key in buttons) {
        const button = document.createElement('button');
        button.innerHTML = `<i class="${buttons[key].icon}"></i>` + (buttons[key].text || '');
        button.addEventListener('click', buttons[key].action);
        toolbar.appendChild(button);

        // Set active state on transaction
        editor.on('transaction', () => {
            const headingLevel = key.startsWith('h') ? { level: parseInt(key.charAt(1)) } : {};
            button.classList.toggle('is-active', editor.isActive(key.startsWith('h') ? 'heading' : key, headingLevel));
        });
    }

    // --- HANDLE IMAGE UPLOAD ---
    fileInput.addEventListener('change', event => {
        const file = event.target.files[0];
        if (!file) return;

        const formData = new FormData();
        formData.append('upload', file);

        fetch('{{ route("admin.posts.uploadImage") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.url) {
                editor.chain().focus().setImage({ src: data.url }).run();
            }
        })
        .catch(error => {
            console.error('Image upload failed:', error);
            alert('Image upload failed.');
        });
    });
</script>