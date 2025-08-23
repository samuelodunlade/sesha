// resources/js/ckeditor.js
import { ClassicEditor } from 'ckeditor5'; // Or your chosen build

const initializeCKEditor = (elementId, livewireProperty) => {
    ClassicEditor
        .create(document.querySelector(`#${elementId}`), {
            // CKEditor configuration options here
        })
        .then(editor => {
            editor.model.document.on('change:data', () => {
                // Update Livewire property when CKEditor data changes
                @this.set(livewireProperty, editor.getData());
            });
        })
        .catch(error => {
            console.error(error);
        });
};

window.initializeCKEditor = initializeCKEditor; // Expose the function globally