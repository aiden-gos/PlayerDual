{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> Users</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('game') }}"><i class="nav-icon la la-gamepad"></i> Games</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-lock-open"></i> Roles</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('order') }}"><i class="nav-icon la la-file-invoice-dollar"></i> Orders</a></li>
