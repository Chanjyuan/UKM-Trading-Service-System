@extends('layouts.master')

@section('title')
    Dashboard | UKM Trading & Service System
@endsection

@section('content')
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">person</i>
                  </div>
                  <p class="card-category"><strong>REGISTERED USERS</strong></p>
                  <h3 class="card-title">{{$userCount}}
<!--                     <small>GB</small> -->
                  </h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">double_arrow</i>
                    <a href="/accounts">View all</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">shopping_basket</i>
                  </div>
                  <p class="card-category"><strong>TOTAL PRODUCTS</strong></p>
                  <h3 class="card-title">{{$productCount}}</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">double_arrow</i>
                    <a href="/posts">View all</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">handyman</i>
                  </div>
                  <p class="card-category"><strong>TOTAL SERVICES</strong></p>
                  <h3 class="card-title">{{$serviceCount}}</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">double_arrow</i>
                    <a href="/posts">View all</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">view_module</i>
                  </div>
                  <p class="card-category"><strong>TOTAL CATEGORIES</strong></p>
                  <h3 class="card-title">{{$categoryCount}}</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">double_arrow</i>
                    <a href="/categories">View all</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="card card-chart">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Monthly Posts Created</h4>
                </div>
                <div class="card-body">
                  <canvas id="canvas2" height="430" width="600"></canvas>
                  <!--
                  <p class="card-category">
                  <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p> 
                  1-->
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">access_time</i>Last updated at @php  echo date('F j, Y', time() ) @endphp
                  </div>
                </div>
              </div>
              <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
              <script>
                  var month = <?php echo $month; ?>;
                  var post2 = <?php echo $post2; ?>;
                  var post3 = <?php echo $post3; ?>;
                  

                  window.onload = function() {
                      var ctx = document.getElementById("canvas2").getContext("2d");
                      window.myBar = new Chart(ctx, {
                          type: 'line',
                          data: {
                              datasets: [{
                                  label: '2020',
                                  data: post2,
                                  backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                  borderColor: 'rgba(255, 99, 132, 0.2)',
                              }, {
                                  label: '2021',
                                  data: post3,
                                  backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                  borderColor: 'rgba(54, 162, 235, 0.2)',

                                  // Changes this dataset to become a line
                                  type: 'line'
                              }],
                              labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                          },
                          options: {
                              elements: {
                                  rectangle: {
                                      borderWidth: 1,
                                      borderSkipped: 'bottom'
                                  }
                              },
                              responsive: true,
                              title: {
                                  display: true,
                                  text: 'Monthly Posts Created'
                              },
                              legend: {
                              position: 'bottom',
                              labels: {
                                  boxWidth: 20,
                              }
                          },
                          }
                      });
                  };
              </script>
            </div>
            <div class="col-md-4">
                <div class="card card-chart">
                  <div class="card-header card-header-primary">
                    <h4 class="card-title">Post Status</h4>
                  </div>
                  <div class="card-body">
                    <canvas id="myChart3" width="350" height="250"></canvas>
                  </div>
                  <div class="card-footer">
                    <div class="stats">
                      <i class="material-icons">access_time</i>Last updated at @php  echo date('F j, Y', time() ) @endphp
                    </div>
                  </div>
                </div>
                <script>
                var sta1 = <?php echo $sta1; ?>;
                var sta2 = <?php echo $sta2; ?>;
                var sta3 = <?php echo $sta3; ?>;
                var sta4 = <?php echo $sta4; ?>;
                var ctx = document.getElementById('myChart3');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Available', 'Pending', 'Traded', 'Sold'],
                        datasets: [{
                            label: 'Post',
                            data: [sta1, sta2, sta3, sta4],
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                            ],
                            borderColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 99, 132, 1)',
                            ],
                            borderWidth: 1
                        }]
                        },
                        options: {
                            animation: {
                              animationScale: true
                            },
                            responsive: true,
                            title: {
                                display: true,
                                text: 'Posts By Status'
                            },
                            legend: {
                                display: false,
                                position: 'bottom',
                                labels: {
                                    boxWidth: 20,
                                }
                            },
                            scales: {
                              yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                              }]
                            }
                        }
                });
                </script>
              </div>
            <div class="col-md-4">
              <div class="card card-chart">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Top Categories</h4>
              </div>
                  <div class="card-body">
                    <canvas id="myChart" width="350" height="250"></canvas>
                  </div>
                <div class="card-footer">
               <div class="stats">
                    <i class="material-icons">access_time</i>Last updated at @php  echo date('F j, Y', time() ) @endphp
                  </div>
                </div>
              </div>
              <script>
              var catname = @json($catname);
              var cname = [catname];
              var cat1 = <?php echo $cat1; ?>;
              var cat2 = <?php echo $cat2; ?>;
              var cat3 = <?php echo $cat3; ?>;
              var cat4 = <?php echo $cat4; ?>;
              var cat5 = <?php echo $cat5; ?>;
              var ctx = document.getElementById('myChart');
              var myChart = new Chart(ctx, {
                  type: 'doughnut',
                  data: {
                      labels: cname[0],
                      datasets: [{
                          label: 'Post',
                          data: [cat1, cat2, cat3, cat4, cat5],
                          backgroundColor: [
                              'rgba(255, 99, 132, 0.2)',
                              'rgba(54, 162, 235, 0.2)',
                              'rgba(255, 206, 86, 0.2)',
                              'rgba(75, 192, 192, 0.2)',
                              'rgba(153, 102, 255, 0.2)',
                              'rgba(255, 159, 64, 0.2)'
                          ],
                          borderColor: [
                              'rgba(255, 99, 132, 1)',
                              'rgba(54, 162, 235, 1)',
                              'rgba(255, 206, 86, 1)',
                              'rgba(75, 192, 192, 1)',
                              'rgba(153, 102, 255, 1)',
                              'rgba(255, 159, 64, 1)'
                          ],
                          borderWidth: 1
                      }]
                      },
                      options: {
                          animation: {
                            animationScale: true
                          },
                          responsive: true,
                          title: {
                              display: true,
                              text: 'Posts by Categories'
                          },
                          legend: {
                              position: 'bottom',
                              labels: {
                                  boxWidth: 20,
                              }
                          },
                          scales: {
                          }
                      }
              });
              </script>
            </div>
          </div>
          <div class="row">
              <div class="col-md-4">
                <div class="card card-chart">
                  <div class="card-header card-header-primary">
                    <h4 class="card-title">Gender</h4>
                  </div>
                  <div class="card-body">
                    <canvas id="myChart2" width="350" height="250"></canvas>
                  </div>
                  <div class="card-footer">
                    <div class="stats">
                      <i class="material-icons">access_time</i>Last updated at @php  echo date('F j, Y', time() ) @endphp
                    </div>
                  </div>
                </div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
                <script>
                var gen1 = <?php echo $gen1; ?>;
                var gen2 = <?php echo $gen2; ?>;
                var ctx = document.getElementById('myChart2');
                var myChart2 = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Male', 'Female'],
                        datasets: [{
                            label: 'Post',
                            data: [gen1, gen2],
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                            ],
                            borderColor: [
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 99, 132, 1)',
                            ],
                            borderWidth: 1
                        }]
                        },
                        options: {
                            animation: {
                              animationScale: true
                            },
                            responsive: true,
                            title: {
                                display: true,
                                text: 'Registered Users By Gender'
                            },
                            legend: {
                                position: 'bottom',
                                labels: {
                                    boxWidth: 20,
                                }
                            },
                            scales: {
                            }
                        }
                });
                </script>
              </div>
            <div class="col-md-4">
              <div class="card card-chart">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Monthly Users Registered</h4>
                </div>
                <div class="card-body">
                  <canvas id="canvas" height="430" width="600"></canvas>
                  <!--
                  <p class="card-category">
                  <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p> 
                  1-->
                </div>
             <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">access_time</i>Last updated at @php  echo date('F j, Y', time() ) @endphp
                  </div>
                </div>
              </div>
              <script>
                  var month2 = <?php echo $month2; ?>;
                  var post4 = <?php echo $post4; ?>;
                  var post5 = <?php echo $post5; ?>;
                  

                 
                      var ctx = document.getElementById("canvas").getContext("2d");
                      window.myBar = new Chart(ctx, {
                          type: 'bar',
                          data: {
                              datasets: [{
                                  label: '2020',
                                  data: post4,
                                  backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                  borderColor: 'rgba(255, 99, 132, 1)',
                              }, {
                                  label: '2021',
                                  data: post5,
                                  backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                  borderColor: 'rgba(54, 162, 235, 1)',

                                  // Changes this dataset to become a line
                                  type: 'bar'
                              }],
                              labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                          },
                          options: {
                              elements: {
                                  rectangle: {
                                      borderWidth: 1,

                                      borderSkipped: 'bottom'
                                  }
                              },
                              responsive: true,
                              title: {
                                  display: true,
                                  text: 'Monthly Users Registered'
                              },
                              legend: {
                              position: 'bottom',
                              labels: {
                                  boxWidth: 20,
                              }
                          },
                          }
                      });
                  
              </script>
            </div>
            <div class="col-md-4">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Trending Product/Service</h4>
                  <p class="card-category">Top 3 posts with most offers received</p>
                </div>
                <div class="card-body table-responsive">
                  @if(count($offers) > 0)
                  <table class="table table-hover">
                    <thead class="text-primary">
                      <th>#</th>
                      <th>Title</th>
                      <th>No. of offers</th>
<!--                       <th>Actions</th> -->
                    </thead>
                      <tbody>
                        <?php $no = 1; ?>
                        @forelse($offers as $offer)
                        <tr>
                            <td>{{$no}}</td>
                            <td><a href="/posts/{{$offer->id}}">{{ Str::limit($offer->title, 25) }}</td>
                            <td>{{$offer->total_offers}}</td>
                        <?php $no++; ?>
                        </tr>
                        @empty
                            <li>No offers</li>
                        @endforelse
                      </tbody>
                  </table>
                  @endif
                </div>
              <div class="card-footer">
               <div class="stats">
                    <i class="material-icons">access_time</i>Last updated at @php  echo date('F j, Y', time() ) @endphp
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection

@section( 'scripts' )
@endsection

<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif 
                        You are logged in as an Admin!<br><br>
                        <a href="/accounts" class="btn btn-outline-primary btn-block">Manage Account</a><br>
                        <a href="/posts" class="btn btn-outline-primary btn-block">Manage Post</a><br>
                        <a href="/categories" class="btn btn-outline-primary btn-block">Manage Categories</a>
                </div>
            </div>    
        </div>
    </div>
</div> -->
