<nav id="list-property-navbar" class="navbar navbar-expand-lg navbar-light bg-white nav-border fixed-top navbar-transparent py-4" solid-on-scroll>
    <div class="container" style="padding: 0px">
        <a class="navbar-brand" href="#" data-toggle="modal" data-target="#modalConfirmation" style="height: 36px;margin: 0px;padding: 0px">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarListPropertyContent"
            aria-controls="navbarListPropertyContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarListPropertyContent">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item {{ ((isset($step) && $step <= 3) || (!isset($step))) ? 'active' : '' }}">
                        <a href="{{ isset($property) ? '/create-property/' . $property->id . '/1' : '' }}">
                            <span>1</span>
                            {{ getLocale($locale_navbar_list_property, 'label-1', 'Basic property information') }}
                        </a>
                    </li>
                    <li class="breadcrumb-item {{ ((isset($step) && $step >= 4 && $step <= 7) || (!isset($step))) ? 'active' : '' }}" aria-current="page">
                        <a href="{{ isset($property) ? '/create-property/' . $property->id . '/4' : '' }}" class="{{ ((isset($step) && $step < 4) || (!isset($step))) ? 'disabled' : '' }}">
                            <span>2</span>
                            {{ getLocale($locale_navbar_list_property, 'label-2', 'Tell us the details') }}
                        </a>
                    </li>
                    <li class="breadcrumb-item {{ ((isset($step) && $step >= 8 && $step <= 9) || (!isset($step))) ? 'active' : '' }}" aria-current="page">
                        <a href="{{ isset($property) ? '/create-property/' . $property->id . '/' . ($property->is_entire_space ? 8 : 9) : '' }}" class="{{ ((isset($step) && $step < 8) || (!isset($step))) ? 'disabled' : '' }}">
                            <span>3</span>
                            {{ getLocale($locale_navbar_list_property, 'label-3', 'Payment preferences') }}
                        </a>
                    </li>
                    <li class="breadcrumb-item {{ ((isset($step) && $step >= 10) || (!isset($step))) ? 'active' : '' }}" aria-current="page">
                        <a href="{{ isset($property) ? '/create-property/' . $property->id . '/10' : '' }}" class="{{ ((isset($step) && $step < 10) || (!isset($step))) ? 'disabled' : '' }}">
                            <span>4</span>
                            {{ getLocale($locale_navbar_list_property, 'label-4', 'Review & Submit') }}
                        </a>
                    </li>
                </ol>
            </nav>
            <a class="save-draft-link saveDraft" href="#">
                {{ getLocale($locale_navbar_list_property, 'label-5', 'Save as Draft') }}
            </a>
        </div>
    </div>
</nav>
