<div>
    <!-- Heading or Trigger Removed -->
    
    <!-- Content Previously in the Modal Now Directly on the Page -->
    <div class="mt-8">
        <div class="max-w-4xl mx-auto py-4 px-6 bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="text-center">
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Edit Raffle Winner Numbers</h3>
                <form wire:submit="saveChanges">
                    @for ($i = 1; $i <= 7; $i++)
                        <input type="text" wire:model="winner_number_{{ $i }}" placeholder="winner_number_{{ $i }}" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" @if($sorted) readonly @endif>
                    @endfor
                    <div class="mt-5">
                        <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">Save Changes</button>
                        <button type="button" class="inline-flex justify-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2" wire:click="$refresh">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
