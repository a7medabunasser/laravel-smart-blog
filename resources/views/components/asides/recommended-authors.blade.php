@props([
    'title' => 'Recommended Authors',
    'authors' => [
        [
            'name' => 'Sarah Drasner',
            'role' => 'Software Engineer',
            'avatar' =>
                'https://lh3.googleusercontent.com/aida-public/AB6AXuB_bDNza0_XsizBBXy317LgL0ZlmEMBGHRNKyKJQEHUTZshyhzuRibQZzQeQZzBZYYQiReJ2d-IiJwtoIjp6M6rGrrwY37laL6K4BthiktNmgwhd0qebRtgpHmf8yFhbk-tHrPmUa7BNZsDbuhL6IgYwEAUf_kGkv_NiAdgkdMoXonaLJXpkAtuWiOU1uM4o9ZxZjLoB4P657GWFnuaJ4zwrnfXzPwxL1DmQ-hiP1T0i5Tr4yNY1JUGm0wgGbbwqoDe_zItDbBhPO9s',
        ],
        [
            'name' => 'David Perell',
            'role' => 'Writer & Educator',
            'avatar' =>
                'https://lh3.googleusercontent.com/aida-public/AB6AXuDEbvciYQ2X_kcFKWWe0O2L03yycemd88WyF_ooBIPwvG-WUezMyveSVstWiBM3XBuBVeVDzlceL-_gL4AgUIr6BEBpg3Euz2S2UzZN3b7J0xsam1LeGO1NhpU_0esyYJLMpFBq04g-yrbxML5Mh9hqxz5h5TIJ9P7mJfg6g-cWjvM7qDXLTdmFZBp2k_85lHK2C98M3j3TVo-8bN-Fxw0iZjBGwnUEnXJTIzcuZiKkPQIYxNt5ft8vlUeIg_jxv3WpCbfdLVr_BibE',
        ],
        [
            'name' => 'Alice Wong',
            'role' => 'Ethics in Tech',
            'avatar' =>
                'https://lh3.googleusercontent.com/aida-public/AB6AXuBn451ZfbDr0Yg1IXraoXumBVLm-GRjvj1ID8YSBo0NiOHTR4h-nTwkze6WtbjRnNOOMDcBV7PVYIEX2ErQLZ5CS0pjQHCWUfvRmnxBdvz8-Vx2EBwEKvXbfHCqrNa1VTMg8U0jzBuUI677uzcLVYBXfX-MGBuqjb8F88PuUlDth4sZu3gUuA2PIYmrVS-QFLFolBrLmvCbiZ1MixmBXlkAL8-XnIM-WJuv7SMkmfwFvY9i6LBBcJEWfjZDfTG8AOPKgzwjZMRCMCdJ',
        ],
    ],
])
<div class="space-y-6">
    <h3 class="font-ui-label text-ui-label uppercase tracking-widest text-secondary font-bold">{{ $title }}</h3>
    <div class="space-y-4">
        @for ($i = 0; $i < count($authors); $i++)
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <img alt="User" class="w-10 h-10 rounded-full object-cover" src="{{ $authors[$i]['avatar'] }}" />
                    <div>
                        <p class="font-ui-label text-ui-label font-bold text-on-surface">{{ $authors[$i]['name'] }}</p>
                        <p class="font-metadata text-metadata text-secondary">{{ $authors[$i]['role'] }}</p>
                    </div>
                </div>
                <button
                    class="px-3 py-1 border border-on-surface text-on-surface rounded-full font-metadata text-metadata font-bold hover:bg-on-surface hover:text-white transition-all">Follow</button>
            </div>
        @endfor
    </div>
</div>
