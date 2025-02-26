/**
 * Plugin Checker - Helps diagnose library loading issues
 */
(function() {
    // Function to check if a plugin is loaded
    function checkPlugin(pluginName, checkFunction) {
        try {
            let isLoaded = checkFunction();
            console.log(`${pluginName} loaded: ${isLoaded ? 'YES' : 'NO'}`);
            return isLoaded;
        } catch (e) {
            console.error(`Error checking ${pluginName}:`, e);
            return false;
        }
    }

    // Wait for the document to be ready
    $(document).ready(function() {
        console.log('==== Plugin Status Check ====');

        // Check jQuery version
        console.log(`jQuery version: ${$.fn.jquery}`);

        // Check Bootstrap version
        checkPlugin('Bootstrap', function() {
            return typeof $.fn.modal === 'function';
        });

        // Check bootstrap-select
        checkPlugin('Bootstrap-select', function() {
            return typeof $.fn.selectpicker === 'function';
        });

        // Check DataTables
        checkPlugin('DataTables', function() {
            return typeof $.fn.DataTable === 'function';
        });

        // Check for multiple jQuery instances
        if (window.jQuery && $ !== window.jQuery) {
            console.error('Multiple jQuery instances detected!');
        }

        console.log('===========================');
    });
})();
