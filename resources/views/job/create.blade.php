<x-layout>
    <x-page-heading>New Job</x-page-heading>

    <!-- Form Container with Responsive Grid Layout -->
    <div class="flex justify-center p-4 sm:p-4 lg:p-2">
        <x-forms.form method="POST" id="job-form" action="/jobs"
            class="w-full sm:w-3/4 md:w-2/3 lg:w-1/2 grid grid-cols-1 gap-6 lg:grid-cols-2 mb-8 lg:mb-4">
            <!-- Left Column -->
            <div class="space-y-4">
                <x-forms.input label="Title" name="title" placeholder="CEO"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                <x-forms.input label="Salary" name="salary" placeholder="90,000 Tk || 40,000-50,000 TK"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                <x-forms.input label="Location" name="location" placeholder="Dhaka, Bangladesh"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                <x-forms.input label="URL" name="url" placeholder="https://acme.com/jobs/ceo-wanted"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <!-- Right Column -->
            <div class="space-y-4">
                <x-forms.select label="Schedule" name="schedule"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>Select</option>
                    <option>Part Time</option>
                    <option>Full Time</option>
                </x-forms.select>

                <x-forms.checkbox label="Feature (Costs Extra)" name="featured" class="h-5 w-5 text-blue-500" />

                <!-- Tags Section in One Column -->
                <div class="flex flex-col space-y-2">
                    <x-forms.input label="Tags (Add a tag and press enter or select from below)" id="tag-input"
                        placeholder="Web Development" name="tag-input"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />

                    <div id="suggested-tags" class="text-sm text-gray-600"></div>

                    <div id="selected-tags" class="mt-2 text-sm text-gray-700">Selected Tags:</div>

                    <!-- Error message container -->
                    <div id="error-message" class="text-red-500 text-sm mt-2"></div>
                </div>

                <x-forms.button
                    class="w-full py-3 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Publish</x-forms.button>
            </div>
        </x-forms.form>
    </div>
</x-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        let selectedTags = [];

        // Fetch suggested tags on page load (limit to 7)
        $.ajax({
            url: '/tags',
            method: 'GET',
            success: function(tags) {
                let tagList = '';
                tags.slice(0, 7).forEach(tag => { // Limit to 7 tags
                    tagList +=
                        `<button type="button" class="suggested-tag bg-gray-200 text-gray-700 py-1 px-2 rounded m-1 hover:bg-gray-300 transition" data-name="${tag.name}">${tag.name}</button>`;
                });
                $('#suggested-tags').html(tagList);
            }
        });

        // Add tag when user clicks on a suggested tag
        $(document).on('click', '.suggested-tag', function() {
            let tagName = $(this).data('name');
            addTag(tagName);
        });

        // Add custom tag when Enter is pressed in the tag input
        $('#tag-input').on('keypress', function(e) {
            if (e.which === 13 || e.which === 10) { // Both default and numeric keypad Enter
                e.preventDefault();
                let tagName = $(this).val().trim();
                if (tagName && selectedTags.length < 5) { // Check if not already selected and max 5 tags
                    addTag(tagName);
                    $(this).val(''); // Clear the input field
                }
            }
        });

        // Add a tag (avoid duplicates, add hidden input, and display visually)
        function addTag(tagName) {
            if (selectedTags.length >= 5) {
                showError("You can only add up to 5 tags.");
                return;
            }

            if (selectedTags.includes(tagName)) {
                showError("This tag has already been added.");
                return;
            }

            selectedTags.push(tagName);

            // Add to selected tags display
            $('#selected-tags').append(`
                <span class="tag-item bg-blue-100 text-blue-700 py-1 px-2 rounded inline-flex items-center m-1">
                    ${tagName}
                    <button type="button" class="remove-tag ml-2 bg-red-500 text-white rounded-full h-5 w-5 flex items-center justify-center focus:outline-none">&times;</button>
                </span>
            `);

            // Add hidden input for form submission
            $('#job-form').append(`<input type="hidden" name="tags[]" value="${tagName}" class="tag-hidden-input">`);

            // Clear the error message if tag is successfully added
            $('#error-message').text('');
        }

        // Remove tag when the "remove" button is clicked
        $(document).on('click', '.remove-tag', function() {
            let tagName = $(this).parent().text().trim().replace("×", "");
            selectedTags = selectedTags.filter(tag => tag !== tagName);

            // Remove visual tag display
            $(this).parent().remove();

            // Remove the corresponding hidden input
            $(`input[name="tags[]"][value="${tagName}"]`).remove();

            // Clear the error message if tag is removed
            $('#error-message').text('');
        });

        // Function to show error messages
        function showError(message) {
            $('#error-message').text(message); // Display error message below the input
        }
    });
</script>