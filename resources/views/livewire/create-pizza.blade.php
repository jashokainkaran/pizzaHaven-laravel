<div style="padding: 20px; max-width: 400px; margin: auto;">
    @if (session()->has('message'))
        <div style="background: #d1e7dd; color: #0f5132; padding: 10px; margin-bottom: 10px;">
            {{ session('message') }}
        </div>
    @endif

    <input type="text" wire:model="name" placeholder="Pizza Name" style="display:block;width:100%;margin-bottom:10px;" />
    <input type="text" wire:model="category" placeholder="Category" style="display:block;width:100%;margin-bottom:10px;" />
    <input type="number" wire:model="price" placeholder="Price" style="display:block;width:100%;margin-bottom:10px;" />
    <textarea wire:model="description" placeholder="Description" style="display:block;width:100%;margin-bottom:10px;"></textarea>
    <input type="text" wire:model="image" placeholder="Image URL" style="display:block;width:100%;margin-bottom:10px;" />

    <button wire:click="save" style="background:#007bff;color:white;padding:10px 20px;border:none;border-radius:5px;cursor:pointer;">
        Create Pizza
    </button>
</div>
