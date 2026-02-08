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
                        <span class="h5 font-bold m-t block">{{ $processingCount }}</span>
                        <small class="text-muted m-b block">Processing</small>
                    </div>
                    <div class="col">
                        <span class="h5 font-bold m-t block">{{ $readyCount }}</span>
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-people fs-3 mb-1" viewBox="0 0 16 16">
                                <path
                                    d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4" />
                            </svg>
                            <span class="stat-number">{{ $activeUserCount }}</span>
                            <span class="stat-label">Active User</span>
                        </div>
                    </div>

                    <div class="col">
                        <div class="stat-card">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-person fs-3 mb-1" viewBox="0 0 16 16">
                                <path
                                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                            </svg>
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
