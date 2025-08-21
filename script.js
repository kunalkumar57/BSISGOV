// script.js
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const headline = form.querySelector('#headline');
            if (headline && headline.value.trim() === '') {
                alert('Headline is required!');
                e.preventDefault();
            }
            const content = form.querySelector('#content');
            if (content && content.value.trim() === '') {
                alert('Content is required!');
                e.preventDefault();
            }
        });
    });

    // Simulate rich text editor for content textarea
    const contentAreas = document.querySelectorAll('#content');
    contentAreas.forEach(area => {
        const toolbar = document.createElement('div');
        toolbar.className = 'toolbar mb-2';
        toolbar.innerHTML = `
            <button type="button" class="btn btn-sm btn-secondary me-1" onclick="insertText(this, '**', '**')">Bold</button>
            <button type="button" class="btn btn-sm btn-secondary me-1" onclick="insertText(this, '*', '*')">Italic</button>
            <button type="button" class="btn btn-sm btn-secondary me-1" onclick="insertText(this, '[Link](', ')')">Link</button>
        `;
        area.before(toolbar);
    });

    window.insertText = function(button, openTag, closeTag) {
        const textarea = button.closest('.toolbar').nextElementSibling;
        const start = textarea.selectionStart;
        const end = textarea.selectionEnd;
        const text = textarea.value;
        const before = text.substring(0, start);
        const selected = text.substring(start, end);
        const after = text.substring(end);
        textarea.value = before + openTag + selected + closeTag + after;
        textarea.focus();
        textarea.selectionStart = start + openTag.length;
        textarea.selectionEnd = end + openTag.length;
    };
});