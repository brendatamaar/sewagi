<div class="col-md-2" style="padding-left: 0px;padding-right: 0px">
    <!-- Sidebar List Property -->
    <nav class="navbar-vertical navbar-light" style="{{ ((isset($step) && $step <= 3) || (!isset($step))) ? 'display: block;' : 'display: none;' }}">
        <ul class="navbar-nav flex-column">
            <li class="nav-item">
                <a id="propertyNavItem1" href="#" class="{{ ((isset($step) && $step == 1) || (!isset($step))) ? '' : 'disabled' }}" style="letter-spacing: 1.8px; padding-left: 0px;padding-right: 0px">
                    {{ getLocale($locale_sidebar_list_property, 'label-1', 'ESTATE TYPE & LIVING CONDITION') }}
                </a>
            </li>
            <li class="nav-item">
                <a id="propertyNavItem2" class="{{ (isset($step) && $step == 2) ? '' : 'disabled' }}" href="#" style="letter-spacing: 1.8px; padding-left: 0px;padding-right: 0p">
                    {{ getLocale($locale_sidebar_list_property, 'label-2', 'BEDROOM & BATHROOM') }}
                </a>
            </li>
            <li class="nav-item">
                <a id="propertyNavItem3" class="{{ (isset($step) && $step == 3) ? '' : 'disabled' }}" href="#" style="letter-spacing: 1.8px; padding-left: 0px;padding-right: 0p">
                    {{ getLocale($locale_sidebar_list_property, 'label-3', 'LOCATION') }}
                </a>
            </li>
        </ul>
    </nav>
    <nav class="navbar-vertical navbar-light" style="{{ ((isset($step) && $step >= 4 && $step <= 7) || (!isset($step))) ? 'display: block;' : 'display: none;' }}">
        <ul class="navbar-nav flex-column">
            <li class="nav-item">
                <a id="propertyNavItem4" href="#" class="{{ ((isset($step) && $step == 4) || (!isset($step))) ? '' : 'disabled' }}" style="letter-spacing: 1.8px">
                    {{ getLocale($locale_sidebar_list_property, 'label-4', 'DESCRIPTION & HOUSE RULES') }}
                </a>
            </li>
            <li class="nav-item">
                <a id="propertyNavItem5" class="{{ (isset($step) && $step == 5) ? '' : 'disabled' }}" href="#" style="letter-spacing: 1.8px">
                    {{ getLocale($locale_sidebar_list_property, 'label-5', 'AMENITIES & FACILITIES') }}
                </a>
            </li>
            <li class="nav-item">
                <a id="propertyNavItem6" class="{{ (isset($step) && $step == 6) ? '' : 'disabled' }}" href="#" style="letter-spacing: 1.8px">
                    {{ getLocale($locale_sidebar_list_property, 'label-6', 'PHOTOS') }}
                </a>
            </li>
            <li class="nav-item">
                <a id="propertyNavItem7" class="{{ (isset($step) && $step == 7) ? '' : 'disabled' }}" href="#" style="letter-spacing: 1.8px">
                    {{ getLocale($locale_sidebar_list_property, 'label-7', 'LEGAL DETAILS') }}
                </a>
            </li>
        </ul>
    </nav>
    <nav class="navbar-vertical navbar-light" style="{{ ((isset($step) && $step >= 8 && $step <= 9) || (!isset($step))) ? 'display: block;' : 'display: none;' }}">
        <ul class="navbar-nav flex-column">
            <li class="nav-item" style="{{ ((isset($property->is_entire_space) && $property->is_entire_space == 1)) ? 'display: block;' : 'display: none;' }}">
                <a id="propertyNavItem4" href="#" class="{{ ((isset($step) && $step == 8) || (!isset($step))) ? '' : 'disabled' }}" style="letter-spacing: 1.8px">
                    {{ getLocale($locale_sidebar_list_property, 'label-8', 'PAYMENT PREFERENCE FOR ENTIRE SPACE') }}
                </a>
            </li>
            <li class="nav-item" style="{{ ((isset($property->is_co_living) && $property->is_co_living == 1)) ? 'display: block;' : 'display: none;' }}" style="letter-spacing: 1.8px">
                <a id="propertyNavItem5" class="{{ (isset($step) && $step == 9) ? '' : 'disabled' }}" href="#">
                    {{ getLocale($locale_sidebar_list_property, 'label-9', 'PAYMENT PREFERENCE FOR CO-LIVING') }}
                </a>
            </li>
        </ul>
    </nav>
    <!-- End Sidebar List Property -->
</div>
