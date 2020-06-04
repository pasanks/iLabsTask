<!-- Sidebar -->
<nav id="sidebar">
    <div class="sidebar-header">
        <h3>P2P Send Money</h3>
    </div>
    <ul class="list-unstyled components">
        <p><i class="fas fa-user" aria-hidden="true"></i> {{\Illuminate\Support\Facades\Auth::user()->email}}</p>
        <li class="{{ (request()->is('home')) ? 'active' : '' }}">
            <a href="{{ url('home') }}">
                <i class="fas fa-chart-line" aria-hidden="true"></i>
                <span>{{trans('Dashboard')}}</span>
            </a>
        </li>
        <li class="{{ (request()->is('master/send_money')) ? 'active' : '' }}">
            <a href="{{ url('master/send_money') }}">
                <i class="fas fa-share-square" aria-hidden="true"></i>
                <span>{{trans('Send Money')}}</span>
            </a>
        </li>
        <li class="{{ (request()->is('master/receivedMoney_View')) ? 'active' : '' }}">
            <a href="{{ url('master/receivedMoney_View') }}">
                <i class="fas fa-money-bill-alt" aria-hidden="true"></i>
                <span>{{trans('Received Money')}}</span>
            </a>
        </li>
        <li class="{{ (request()->is('master/sentMoneyReport_View')) ? 'active' : '' }}">
            <a href="{{ url('master/sentMoneyReport_View') }}">
                <i class="fas fa-file-invoice" aria-hidden="true"></i>
                <span>{{trans('Sent Money Report')}}</span>
            </a>
        </li>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"  class="btn btn-warning">  <i class="fas fa-sign-out-alt" aria-hidden="true"></i>Logout</button>
        </form>
    </ul>
</nav>
