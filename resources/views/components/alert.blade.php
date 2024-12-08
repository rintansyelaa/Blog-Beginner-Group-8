@if(session('success'))
<div class="bg-green-300 overflow-hidden shadow-sm sm:rounded-lg mb-3 border border-green-700">
    <div class="p-6 text-green-700">
        {{ session('success') }}
    </div>
</div>
@endif
@if(session('failed'))
<div class="bg-red-300 overflow-hidden shadow-sm sm:rounded-lg mb-3 border border-red-700">
    <div class="p-6 text-red-700">
        {{ session('failed') }}
    </div>
</div>
@endif
