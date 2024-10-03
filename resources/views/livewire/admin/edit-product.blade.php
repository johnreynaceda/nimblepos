<div>
    <div>
        {{ $this->form }}
    </div>
    <div class="mt-10 flex justify-end">
        <x-button label="Update Product" class="font-semibold" positive right-icon="bookmark-square"
            wire:click="updateRecord" spinner="updateRecord" />
    </div>
</div>
