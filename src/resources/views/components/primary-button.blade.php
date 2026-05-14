<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center rounded-xl bg-[#ff6b35] px-5 py-3 text-sm font-semibold tracking-wide text-white transition duration-200 hover:bg-[#e95b28] focus:outline-none focus:ring-4 focus:ring-[rgba(255,107,53,0.2)] active:translate-y-px']) }}>
    {{ $slot }}
</button>
