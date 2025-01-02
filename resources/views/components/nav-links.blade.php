 @props(['active' => false])
 <li>
     <a class="
    {{ $active
        ? 'block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0'
        : 'block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0' }}"
         aria-current="{{ $active ? 'page' : 'false' }}" {{ $attributes }}>
         {{ $slot }}
     </a>
 </li>
