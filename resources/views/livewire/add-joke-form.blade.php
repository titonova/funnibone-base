@php $exampleJokes = json_decode(json_encode($exampleJokes)); @endphp
<div x-data="{
    jokeFormat: @entangle('jokeFormat'),
}" class="justify-center w-3/4 py-4 mb-2">

    <!-- Add a joke Button -->
    <x-jet-button wire:click="openAddJokeModal" wire:loading.attr="disabled">
        <x-icon name="plus" class="w-5 h-5 " />&nbsp;
        {{ __('Add a Joke') }}
    </x-jet-button>

    <!-- Add Joke Form -->
    <x-jet-dialog-modal wire:model="addJokeModalIsOpen">
        <x-slot name="title">
            {{ __('Add a joke') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <!-- It's a long joke checkbox -->
                <div>
                    <x-jet-label class="text-md">{{ __('Joke format') }} </x-jet-label>
                    <div class="sm:flex">
                        <x-radio id="one-liner" x-model="jokeFormat" wire:model="jokeFormat" value="one-liner"
                        label="One-liner"/>
                        <x-radio id="two-liner" x-model="jokeFormat" wire:model="jokeFormat" value="two-liner"
                        label="Two-liner"/>
                        <x-radio id="long" x-model="jokeFormat" wire:model="jokeFormat" value="long"
                        label="Long"/>

                    </div>
                </div>
                <!-- Title -->
                <div class="mt-4" x-show="['two-liner','long'].includes(jokeFormat)" x-transition>
                    <x-jet-label>
                        Title
                        <span x-show="['long'].includes(jokeFormat)">(optional)</span>
                        <span  x-show="['two-liner'].includes(jokeFormat)" class="text-red-500">*</span>
                    </x-jet-label>
                    <x-jet-input wire:model.defer="title"
                                type="text"
                                class="block w-full mt-1"
                                placeholder="{{ $exampleJokes->$jokeFormat->title }} "
                    />
                    <x-jet-input-error for="title" class="mt-2" />
                </div>
                <!-- Body -->
                <div class="mt-4" x-show="['long'].includes(jokeFormat)" x-transition>
                    <x-jet-label>Body <span class="text-red-500">*</span></x-jet-label>
                    <textarea       wire:model.defer="body"
                                    rows="12"
                                    class="block w-full mt-1 border-gray-300 rounded-md focus:border-indigo-300 focus:ring-opacity-50 focus:ring focus:ring-indigo-200"
                                    placeholder="{{ $exampleJokes->$jokeFormat->body }} "
                                    ></textarea>
                    <x-jet-input-error for="body" class="mt-2" />
                </div>
                <!-- Punchline -->
                <div class="mt-4" x-show="['one-liner', 'two-liner', 'long'].includes(jokeFormat)" x-transition>
                    <x-jet-label>
                        Punchline
                        <span x-show="['long'].includes(jokeFormat)">(optional)</span>
                        <span  x-show="['one-liner', 'two-liner'].includes(jokeFormat)" class="text-red-500">*</span>
                    </x-jet-label>
                    <x-jet-input wire:model.defer="punchline"
                                type="text"
                                class="block w-full mt-1"
                                placeholder="{{ $exampleJokes->$jokeFormat->punchline }}"
                    />
                    <x-jet-input-error for="punchline" class="mt-2" />
                </div>
            </div>
        </x-slot>

        <!-- Modal Footer -->
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('addJokeModalIsOpen')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-3" wire:click="addJoke" wire:loading.attr="disabled">
                {{ __('Add Joke') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
