<div class="wrap">
    <div class="wpdarkmode-tools">
        <div class="section-title">
            <span class="dashicons dashicons-admin-tools"> </span>
            <h3>WP Dark Mode Tools</h3>
        </div>
        <div class="section-body">

            <!-- Export settings  -->
            <div class="__form-group">
                <label for="" class="__form-label">Export Settings</label>
                <div class="__form-content">
                    <button class="button button-primary button-large" id="wpDarkMode_export"><span class="dashicons dashicons-download"></span> <span>Export</span></button>
                    <div class="__form-text">Export current settings as JSON file.</div>
                </div>
            </div>

            <!-- Import settings  -->
            <div class="__form-group">
                <label for="" class="__form-label">Import Settings</label>
                <div class="__form-content">
                    <input type="file" id="wpDarkMode_importer" style="display:none" accept="application/JSON">
                    <label for='wpDarkMode_importer' class="button button-primary button-large"><span class="dashicons dashicons-upload"></span> <span>Import</span></label>            
                    <div class="__form-text">Import settings from JSON file which is exported through WP Dark Mode.</div>
                </div>
            </div>

            <!-- Reset settings  -->
            <div class="__form-group">
                <label for="" class="__form-label">Reset Settings</label>
                <div class="__form-content">
                    <button class="button button-danger button-large"  id="wpDarkMode_reset"><span class="dashicons dashicons-image-rotate"></span> <span>Reset Settings</span></button>
                    <div class="__form-text">Reset all settings to default. We recommend to export current settings before you reset the settings.</div>
                </div>
            </div>
        </div>
    </div>
</div>