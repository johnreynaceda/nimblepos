<div>
    <div class="w-full h-40 mb-3 border rounded-xl overflow-hidden">
        @if ($this->image_edit)
            <img src="{{ $this->image_edit->temporaryUrl() }}" alt="">
        @else
            <img src="{{ Storage::url($this->image) }}" alt="">
        @endif
    </div>
    <div>
        <x-input type="file" wire:model="image_edit" />
        <span wire:loading wire:target="image_edit" class="text-sm text-green-600">Uploading...</span>
    </div>
</div>
