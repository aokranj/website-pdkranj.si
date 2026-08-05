(function () {

    const moonIcon = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-moon-stars-fill" viewBox="0 0 16 16">
  <path d="M6 .278a.77.77 0 0 1 .08.858 7.2 7.2 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277q.792-.001 1.533-.16a.79.79 0 0 1 .81.316.73.73 0 0 1-.031.893A8.35 8.35 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.75.75 0 0 1 6 .278"/>
  <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.73 1.73 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.73 1.73 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.73 1.73 0 0 0 1.097-1.097zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.16 1.16 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.16 1.16 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732z"/>
</svg>`;
    const sunIcon = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-brightness-high-fill" viewBox="0 0 16 16">
  <path d="M12 8a4 4 0 1 1-8 0 4 4 0 0 1 8 0M8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0m0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13m8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5M3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8m10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0m-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0m9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707M4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708"/>
</svg>`;

    const THEME_COLORS = {
        darkmode: { bg: '#1B2836', text: '#fff',    link: '#459BE6' },
        chathams: { bg: '#171717', text: '#bfb7c0', link: '#f776f0' },
        pumpkin:  { bg: '#1e1d19', text: '#d6cb99', link: '#ff9323' },
        mustard:  { bg: '#151819', text: '#d5d6d7', link: '#daa40b' },
        concord:  { bg: '#171717', text: '#bfb7c0', link: '#f776f0' },
        default:  { bg: 'rgb(32, 35, 36)', text: '#f0f0f0', link: 'skyblue' },
    };

    const getActiveThemeColors = () => {
        const active = Array.from( document.documentElement.classList )
            .find( c => c.startsWith( 'wp-dark-mode-theme-' ) );
        const key = active ? active.replace( 'wp-dark-mode-theme-', '' ) : 'default';
        return THEME_COLORS[ key ] || THEME_COLORS.default;
    };

    const buildDarkCSS = () => {
        const c = getActiveThemeColors();
        // Fix: Hestia local fonts hosting injects a corrupted CSS file (HTML error page) that sets
        // html { background: #fff } inside the TinyMCE iframe. Override html bg alongside body.
        return `html, body { background-color: ${c.bg}; } body { color: ${c.text}; } a { color: ${c.link}; }`;
    };
    const STYLE_ID = 'wp-dark-mode-classic-editor-style';

    // Per-editor instance map so multiple Classic blocks on one page each get toggled independently.
    const editorMap = new Map();

    tinymce.PluginManager.add('dark_mode_button', function (editor, url) {

        editor.addButton('dark_mode_button', {
            text: ``,
            icon: 'dark_mode_button',
            tooltip: 'Toggle Dark Mode',
            onclick: function () {
                const state = editorMap.get(editor.id) || 0;
                if ( state == 1 ) {
                    removeDarkModeOnMCE(editor);
                } else {
                    applyDarkModeOnMCE(editor);
                }
            },
            onPostRender: function () {
                const btnEl = this.getEl();
                const savedMode = localStorage.getItem("wp_dark_mode_classic_editor_mode") || "0";
                btnEl.innerHTML = '<button class="mce-dark-mode-button">' + (savedMode == 1 ? sunIcon : moonIcon) + '</button>';
            }
        });

        editor.on('init', function () {
            initDarkModeOnMCE(editor);
            // Re-apply colors when Gutenberg theme changes (only if this editor is already dark).
            document.addEventListener('wp_dark_mode_theme_change', function () {
                if ( editorMap.get(editor.id) === 1 ) {
                    applyDarkModeOnMCE(editor);
                }
            });
        });

    });

    function applyDarkModeOnMCE(editor) {
        localStorage.setItem("wp_dark_mode_classic_editor_mode", 1);
        editorMap.set(editor.id, 1);

        // Inject CSS directly into the TinyMCE editable document.
        const doc = editor.getDoc();
        if ( doc && doc.head ) {
            let style = doc.getElementById(STYLE_ID);
            if ( ! style ) {
                style = doc.createElement('style');
                style.id = STYLE_ID;
                doc.head.appendChild(style);
            }
            style.textContent = buildDarkCSS();
        }

        updateButtonIcon(editor, sunIcon);
    }

    function removeDarkModeOnMCE(editor) {
        localStorage.setItem("wp_dark_mode_classic_editor_mode", 0);
        editorMap.set(editor.id, 0);

        const doc = editor.getDoc();
        if ( doc ) {
            const style = doc.getElementById(STYLE_ID);
            if ( style ) {
                style.remove();
            }
        }

        updateButtonIcon(editor, moonIcon);
    }

    function updateButtonIcon(editor, icon) {
        // Try via editor container first (works in both standalone and Gutenberg block contexts).
        try {
            const container = editor.getContainer();
            const btnEl = container && container.querySelector('.mce-dark-mode-button');
            if ( btnEl ) {
                btnEl.innerHTML = icon;
                return;
            }
        } catch (e) {}
        // Fallback: search in document (standalone Classic Editor page).
        const btnEl = document.querySelector('.mce-dark-mode-button');
        if ( btnEl ) {
            btnEl.innerHTML = icon;
        }
    }

    function initDarkModeOnMCE(editor) {
        const savedMode = localStorage.getItem("wp_dark_mode_classic_editor_mode") || 0;
        if ( savedMode == 1 ) {
            applyDarkModeOnMCE(editor);
        } else {
            removeDarkModeOnMCE(editor);
        }
    }

})();
