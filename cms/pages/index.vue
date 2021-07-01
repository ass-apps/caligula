<template>
  
  <div>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="card card-custom bg-dark">
              <div class="card-header border-0">
                  <div class="card-title">
                      <span class="card-icon">
                          <i class="flaticon2-chat-1 text-white"></i>
                      </span>
                      <h3 class="card-label text-white">Ventas</h3>
                  </div>
              </div>
              <div class="separator separator-solid separator-white opacity-20"></div>
              <div class="card-body text-white">
                <h3 class="text-center">4</h3>
              </div>
          </div>
      </div>

        <div class="col-md-4">
            <div class="card card-custom bg-info">
                <div class="card-header border-0">
                    <div class="card-title">
                        <span class="card-icon">
                            <i class="flaticon2-chat-1 text-white"></i>
                        </span>
                        <h3 class="card-label text-white">Productos</h3>
                    </div>
                </div>
                <div class="separator separator-solid separator-white opacity-20"></div>
                <div class="card-body text-white">
                    <h3 class="text-center">3 </h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-custom bg-success">
                <div class="card-header border-0">
                    <div class="card-title">
                        <span class="card-icon">
                            <i class="flaticon2-chat-1 text-white"></i>
                        </span>
                        <h3 class="card-label text-white">Clientes registrados</h3>
                    </div>
                </div>
                <div class="separator separator-solid separator-white opacity-20"></div>
                <div class="card-body text-white">
                    <h3 class="text-center">2 </h3>
                </div>
            </div>
        </div>
      </div>
      <div class="row mt-5">
        <div class="col-md-6 mt-5">
          <client-only>
            <div class="card">
              <div class="card-body">

                <line-chart :data="chartData"></line-chart>
              </div>

            </div>
          </client-only>
        </div>

        <div class="col-md-6 mt-5">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">First</th>
                      <th scope="col">Last</th>
                      <th scope="col">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>Nick</td>
                      <td>Stone</td>
                      <td>
                        <span class="label label-inline label-light-primary font-weight-bold">Pending</span>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>Ana</td>
                      <td>Jacobs</td>
                      <td>
                        <span class="label label-inline label-light-success font-weight-bold">Approved</span>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td>Larry</td>
                      <td>Pettis</td>
                      <td>
                        <span class="label label-inline label-light-danger font-weight-bold">New</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>

            </div>
          </div>
            <div class="col-12 mt-3">
              <div class="card">
                <div class="card-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Nick</td>
                        <td>Stone</td>
                        <td>
                          <span class="label label-inline label-light-primary font-weight-bold">Pending</span>
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td>Ana</td>
                        <td>Jacobs</td>
                        <td>
                          <span class="label label-inline label-light-success font-weight-bold">Approved</span>
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>Pettis</td>
                        <td>
                          <span class="label label-inline label-light-danger font-weight-bold">New</span>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>

              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>

</template>

<script>

export default {
  
  data(){
			return{
        showLine: true,
				chartData: {
					labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'],
					datasets: [
						{
							label: 'Ventas por mes',
							data: [45, 55, 48, 45, 30],
							borderColor: "#00b894",
							backgroundColor:"#00b894",
							fill: false,
						}
					],
					options: {
						responsive: true,
						interaction: {
							mode: 'index',
							intersect: false,
						},
						stacked: false,
						scales: {
							y: {
								type: 'linear',
								display: true,
								position: 'left',
							},
							y1: {
								type: 'linear',
								display: true,
								position: 'right',

								// grid line settings
								grid: {
								drawOnChartArea: false, // only want the grid lines for one axis to show up
								},
							},
						}
					}
				}
			
		  }
  },

}
</script>
