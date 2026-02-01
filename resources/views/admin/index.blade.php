@extends('base.admin')
@section('title', 'Dashboard - Registrar Office (QSU)')
@section('content')
    <div class="row  border-bottom lavander-whip dashboard-header">
        <div class="col-lg-12">
            <h2>Welcome, <strong> {{ Auth::user()->name }}!</strong></h2>
            <small class="text-muted">Overview of recent activity</small>
        </div>
        <div class="col-md-4">
            <ul class="list-group clear-list m-t">
                @forelse ($documents as $d)
                    <li class="list-group-item first-item">
                        <span class="float-right">
                            {{ $d->created_at->diffForHumans() }}
                        </span>
                        <span class="label label-success">{{ $loop->iteration }}</span>
                        <a href="{{ route('admin.document-view', ['id' => $d->dr_id]) }}"
                            class="text-dark"><strong>{{ $d->short_fullname }}</strong>
                            ({{ $d->request_type }})
                        </a>
                    </li>

                @empty
                    <li class="list-group-item text-muted text-center">
                        No recent requests
                    </li>
                @endforelse
            </ul>
        </div>
        <div class="col-md-5">
            <div class="flot-chart dashboard-chart" style="height: 250px; margin-top: -15px;">
                <canvas id="myChart"></canvas>
            </div>
        </div>
        <div class="col-md-3">
            <div class="statistic-box" style="margin-top: -15px;">
                <h4>
                    Request Statistics
                </h4>
                <div class="row text-center">
                    <div class="col">
                        <div class=" m-l-md">
                            <span class="h5 font-bold m-t block">{{ $pendingCount }}</span>
                            <small class="text-muted m-b block">Pending</small>
                        </div>
                    </div>
                    <div class="col">
                        <span class="h5 font-bold m-t block">{{ $approvedCount }}</span>
                        <small class="text-muted m-b block">Processing</small>
                    </div>
                    <div class="col">
                        <span class="h5 font-bold m-t block">{{ $deniedCount }}</span>
                        <small class="text-muted m-b block">Ready for Pickup</small>
                    </div>
                </div>
                <div class="row text-center mb-4">
                    <div class="col">
                        <div class=" m-l-md">
                            <span class="h5 font-bold m-t block">{{ $lastMonthDocumentCount }}</span>
                            <small class="text-muted m-b block">Last Month Document</small>
                        </div>
                    </div>
                    <div class="col">
                        <div class=" m-l-md">
                            <span class="h5 font-bold m-t block">{{ $thisMonthDocumentCount }}</span>
                            <small class="text-muted m-b block">This Month Document</small>
                        </div>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col">
                        <div class="stat-card">
                            <i class="bi bi-people fs-3 mb-2"></i>
                            <span class="stat-number">{{ $activeUserCount }}</span>
                            <span class="stat-label">Active User</span>
                        </div>
                    </div>
                    
                    <div class="col">
                        <div class="stat-card">
                            <i class="bi bi-person fs-3 mb-2"></i>
                            <span class="stat-number">{{ $userCount }}</span>
                            <span class="stat-label">Administrators</span>
                        </div>
                    </div>
                    

                </div>
            </div>
        </div>

    </div>

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-9">
                
            </div>


        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script defer>
        const data = @json($chartData);

        const config = {
            type: 'line',
            data: data,
            options: {
                maintainAspectRatio: false,
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Documents Request'
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: false,
                            text: 'Number of Requests'
                        }
                    },
                    x: {
                        title: {
                            display: false,
                            text: 'Month and Day'
                        }
                    }
                }
            }
        };

        const myChart = new Chart(
            document.getElementById('myChart'),
            config


        );

    </script>
@endsection
