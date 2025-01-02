@props(['fixed' => false])

<footer class="{{ $fixed ? 'fixed bottom-0 left-0 z-20 w-full bg-white' : 'bg-white rounded-lg m-4' }}">
    <div class="w-full mx-auto max-w-screen-xl p-4 flex justify-center gap-4 items-center">
        <div>
            <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© <?php echo date("Y"); ?> <a href=https://mustanjid.github.io/"
                    class="hover:underline text-blue-700 underline">Md Al Mustanjid</a>. Job Space.
            </span>
        </div>
       
        <div class="flex mt-4 sm:justify-center md:mt-0 space-x-5 rtl:space-x-reverse">
            <a href="https://github.com/mustanjid" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z"
                        clip-rule="evenodd" />
                </svg>
                <span class="sr-only">GitHub account</span>
            </a>

            <a href="https://www.linkedin.com/in/mustanjid/" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M18.5 0h-17A1.5 1.5 0 0 0 0 1.5v17A1.5 1.5 0 0 0 1.5 20h17a1.5 1.5 0 0 0 1.5-1.5v-17A1.5 1.5 0 0 0 18.5 0ZM6 17.5H3V7.5h3v10Zm-1.5-11.5a1.751 1.751 0 1 1 0-3.5 1.751 1.751 0 0 1 0 3.5ZM17.5 17.5h-3v-5c0-1.25-.5-2.5-2-2.5s-2.5 1.25-2.5 2.5v5H7V7.5h3v1.25c.5-.75 1.75-1.25 3-1.25 2.5 0 4.5 2 4.5 5v5Z" />
                </svg>
                <span class="sr-only">LinkedIn page</span>
            </a>

            <a href="https://twitter.com/mustanjid_se" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 17">
                    <path fill-rule="evenodd"
                        d="M20 1.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.344 8.344 0 0 1-2.605.98A4.13 4.13 0 0 0 13.85 0a4.068 4.068 0 0 0-4.1 4.038 4 4 0 0 0 .105.919A11.705 11.705 0 0 1 1.4.734a4.006 4.006 0 0 0 1.268 5.392 4.165 4.165 0 0 1-1.859-.5v.05A4.057 4.057 0 0 0 4.1 9.635a4.19 4.19 0 0 1-1.856.07 4.108 4.108 0 0 0 3.831 2.807A8.36 8.36 0 0 1 0 14.184 11.732 11.732 0 0 0 6.291 16 11.502 11.502 0 0 0 17.964 4.5c0-.177 0-.35-.012-.523A8.143 8.143 0 0 0 20 1.892Z"
                        clip-rule="evenodd" />
                </svg>
                <span class="sr-only">Twitter page</span>
            </a>
            
        </div>

    </div>
</footer>

