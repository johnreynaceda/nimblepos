<div>
    <div>
        {{ $this->form }}
    </div>
    <div class="mt-5 flex justify-end space-x-2">
        <x-button label="Cancel" negative icon="arrow-uturn-left" class="font-smeibold"
            href="{{ route('admin.products') }}" />

        <x-button label="Submit Record" wire:click="submitRecord" class="font-smeibold" spinner="submitRecord" slate
            right-icon="arrow-right" />
    </div>
</div>
