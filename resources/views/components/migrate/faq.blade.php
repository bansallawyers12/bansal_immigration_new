@props(['faqs' => []])

<div class="bg-white border border-gray-200 rounded-xl divide-y divide-gray-200" itemscope itemtype="https://schema.org/FAQPage">
    @foreach($faqs as $faq)
        <div class="p-5" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
            <h4 class="font-semibold text-gray-900" itemprop="name">{{ $faq['q'] }}</h4>
            <div class="mt-2 text-gray-700" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <div itemprop="text">{!! $faq['a'] !!}</div>
            </div>
        </div>
    @endforeach
</div>

