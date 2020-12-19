<template>
  <div class="cardbox">
    <div class="cardbox-body">
      <div class="cardbox-heading">
        <div class="row">
          <div class="col-md-5">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-5">
                    <h3>
                      <small class="text-muted">Código: </small>
                      <span class="badge badge-light">{{ female.code }}</span>
                    </h3>
                  </div>
                  <div class="col-md-7">
                    <h3>
                      <small class="text-muted">Genética: </small>
                      <span class="badge badge-light">{{ female.genetics.name }}</span>
                    </h3>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <h3>
                      <small class="text-muted">Condición: </small>
                      <span class="badge badge-light">{{ female.condition }}</span>
                    </h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card card-default">
            <div class="card-body">
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Eventos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="information-tab" data-toggle="tab" href="#information" role="tab" aria-controls="information" aria-selected="true">Información</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Servicios</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Partos y Destetes</a>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <div class="cardbox">
                    <div class="cardbox-heading pb-0">
                      <div class="float-right"><small>Total Eventos: {{ total }}</small></div>
                      <div class="cardbox-title">Lista de Eventos</div>
                      <small>Los registros se ordenaran por fecha, desde el último evento realizado.</small>
                    </div>
                    <div class="p-2 bb">
                      <div class="d-flex align-items-left">
                        <div class="mr-auto"></div>
                        <div class="d-flex text-left">
                          <div class="wd-xxs"><small class="text-muted">Fecha Evento</small></div>
                        </div>
                      </div>
                    </div>
                    <div v-for="fake in fakes" v-if="!loading">
                      <place-holder></place-holder>
                    </div>
                    <div v-if="loading" class="p-2 bb" v-for="(item, index) in events" :key="index">
                      <div class="d-flex align-items-center">
                        <div class="mr-4 ml-2 px-2 text-center rounded thumb32 lh32"
                        :class="item.color">
                          <em class="ion-ios-paper-outline icon-lg"></em>
                        </div>
                        <div class="mr-auto" v-if="item.type === 'inseminations'">
                          <p class="mb-1">
                            <a :href="`/${item.type}/${item.id}/edit`" class="card-link">Inseminación</a>
                            <a href="#" class="delete"><i class="fa fa-trash"></i></a>
                          </p>
                          <small>
                            <b>Hora: </b>{{ item.time }} &nbsp;  
                            <b>Dósis: </b>{{ item.dose }} &nbsp; 
                            <b>Semen: </b>{{ item.semen.code }} &nbsp; 
                            <b>Observación: </b>{{ item.observation }}
                          </small>
                        </div>
                        <div class="mr-auto" v-else-if="item.type === 'weanings'">
                          <p class="mb-1">
                            <a :href="`/${item.type}/${item.id}/edit`" class="card-link">Destete</a>
                            <a href="#" class="delete"><i class="fa fa-trash"></i></a>
                          </p>
                          <small>
                            <b>Cantidad: </b>{{ item.quantity }} &nbsp; 
                            <b>Peso total: </b>{{ item.weight }} &nbsp; 
                            <b>Peso promedio: </b>{{ item.average }}  &nbsp; 
                            <b>Estado: </b>{{ item.state == 'PENDING' ? 'PENDIENTE' : 'CERRADA' }}  &nbsp; 
                            <b>Observación: </b>{{ item.observation }}
                          </small>
                        </div>
                        <div class="mr-auto" v-if="item.type === 'abortions'">
                          <p class="mb-1">
                            <a :href="`/${item.type}/${item.id}/edit`" class="card-link">Aborto</a>
                            <a href="#" class="delete"><i class="fa fa-trash"></i></a>
                          </p>
                          <small>
                            <b>Motivo: </b>{{ item.reason }} &nbsp; 
                            <b>Observación: </b>{{ item.observation }}
                          </small>
                        </div>
                        <div class="mr-auto" v-if="item.type === 'deaths'">
                          <p class="mb-1">
                            <a :href="`/${item.type}/${item.id}/edit`" class="card-link">Baja</a>
                            <a href="#" class="delete"><i class="fa fa-trash"></i></a>
                          </p>
                          <small>
                            <b>Motivo: </b>{{ item.reason }} &nbsp;
                            <b>Peso: </b>{{ item.weight }} &nbsp; 
                            <b>Observación: </b>{{ item.observation }}
                          </small>
                        </div>
                        <div class="mr-auto" v-if="item.type === 'births'">
                          <p class="mb-1">
                            <a :href="`/${item.type}/${item.id}/edit`" class="card-link">Parto</a>
                            <a href="#" class="delete"><i class="fa fa-trash"></i></a>
                          </p>
                          <small>
                            <b>Cantidad: </b>{{ item.quantity }} &nbsp; 
                          </small>
                        </div>
                        <div class="d-flex text-left">
                          <div class="wd-xxs"><strong>{{ item.date | formatDate('DD/MM/YYYY') }}</strong></div>
                        </div>
                      </div>
                    </div>
                    <div class="cardbox-footer">
                      <div class="row">
                        <div class="col-md-4 ml-auto">
                          <nav>
                            <ul class="pagination pagination-rounded justify-content-center">
                              <li :class="[pagination.current_page > 1 ? '' : 'disabled']" class="page-item" >
                                <a href="#" @click.prevent="changePage(pagination.current_page - 1)" class="page-link" aria-label="Previous">
                                  <span class="nav-icon">
                                    <em class="ion-android-arrow-back"></em>
                                  </span>
                                </a>
                              </li>
                              <li v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '']" class="page-item">
                                <a href="#" @click.prevent="changePage(page)" class="page-link" >
                                  {{ page }}
                                </a>
                              </li>
                              <li :class="[pagination.current_page < pagination.last_page ? '' : 'disabled']" class="page-item">
                                <a href="#" @click.prevent="changePage(pagination.current_page + 1)" class="page-link" aria-label="Next">
                                  <span class="nav-icon">
                                    <em class="ion-android-arrow-forward"></em>
                                  </span>
                                </a>
                              </li>
                            </ul>
                          </nav>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="information" role="tabpanel" aria-labelledby="information-tab">
                  <div class="cardbox">
                    <div class="cardbox-heading pb-0">
                      <div class="float-right">
                        <small>Última Actualización: {{ female.updated_at | formatDate('DD/MM/YYYY') }}</small>
                      </div>
                    </div>
                    <div class="cardbox-body">
                      <div class="row">
                        <div class="col-md-4">
                          <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                              <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Fecha de Registro</h5>
                              </div>
                              <p class="mb-1">{{ female.created_at | formatDate('DD/MM/YYYY') }}</p>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                              <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Fecha de Nacimiento</h5>
                              </div>
                              <p class="mb-1">{{ female.date | formatDate('DD/MM/YYYY') }}</p>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                              <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Ubicación Inicial</h5>
                              </div>
                              <p class="mb-1">
                                Nave n° {{ female.location.shed }} - Corral n° {{ female.location.room }}
                              </p>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                              <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Origen</h5>
                              </div>
                              <p class="mb-1">
                                {{ female.origin }}
                              </p>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import PlaceHolder from '../../../components/PlaceHolder.vue'

  export default {
    components: {
      'place-holder': PlaceHolder
    },

    props: {
      female: {
        required: true,
        type: Object
      }
    },

    data() {
      return {
        events: [],
        total: null,
        pagination: {
          'total': 0,
          'current_page': 0,
          'per_page': 0,
          'last_page': 0,
          'from': 0,
          'to': 0
        },
        offset: 3,
        loading: false,
        fakes: 5
      }
    },

    computed: {
      isActived() {
        return this.pagination.current_page;
      },
      pagesNumber() {
        if(!this.pagination.to){
          return [];
        }

        let from = this.pagination.current_page - this.offset; 
        if(from < 1){
          from = 1;
        }

        let to = from + (this.offset * 2); 
        if(to >= this.pagination.last_page){
          to = this.pagination.last_page;
        }

        let pagesArray = [];
        while(from <= to){
          pagesArray.push(from);
          from++;
        }
        return pagesArray;
      }
    },

    mounted() {
      this.getEvents()
    },

    methods: {
      getEvents(page) {
        let vm = this
        vm.loading = false
        axios.get(this.buildURL(page))
        .then((response) => {
          vm.events = response.data.data
          vm.total = response.data.total
          vm.pagination.total = response.data.total
          vm.pagination.current_page = response.data.current_page
          vm.pagination.per_page = response.data.per_page
          vm.pagination.last_page = response.data.last_page
          vm.pagination.from = response.data.from
          vm.pagination.to = response.data.to
          vm.loading = true
        })
      },

      changePage(page) {
        this.pagination.current_page = page;
        this.getEvents(page);
      },

      buildURL(page) {
        let female = `?id=${this.female.id}`
        let pageNumber = `&page=${page}`
        return `/females/events-female${female}${pageNumber}`
      }
    }
  }
</script>

<style scoped>
  a.delete{
    color: red;
  }
  .delete{
    visibility: hidden;
  }
  .mb-1:hover>.delete{
    visibility: visible;
  }
</style>
