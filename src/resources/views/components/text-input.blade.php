@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-[#ff6b35] focus:ring-4 focus:ring-[rgba(255,107,53,0.16)]']) }}>
