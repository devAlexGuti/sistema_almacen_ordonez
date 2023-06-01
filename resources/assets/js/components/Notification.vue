<template>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">{{notifications.length}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span v-if="notifications.length==1" class="dropdown-item dropdown-header">Hoy Tu tienes {{notifications.length}} notificación</span>
          <span v-if="notifications.length>1" class="dropdown-item dropdown-header">Hoy Tu tienes {{notifications.length}} notificaciones</span>
          <div class="dropdown-divider"></div>
          <template v-if="notifications.length">
            <div v-for="item in listar" :key="item.id">
              <!--
              <a href="#" class="dropdown-item">
                <i class="fas fa-shopping-bag text-red mr-2"></i> {{item.compras.msj}}
                <span class="float-right text-muted text-sm badge badge rojo">{{item.compras.numero}}</span>
              </a>
              <div class="dropdown-divider"></div>-->
              <a href="#" class="dropdown-item">
                <i class="fas fa-shopping-cart text-green mr-2"></i> {{item.ventas.msj}}
                <span style="position: relative;top: 1.5px;" class="float-right text-muted text-sm badge badge verde">{{item.ventas.numero}}</span>
              </a>
              <div class="dropdown-divider"></div>
            </div>
          </template>
          <span v-else class="dropdown-item dropdown-header">No tiene notificaciones</span>
        </div>
      </li>
</template>
<script>
export default {     
	props : ['notifications'],
    data (){         
        return {
            arrayNotifications:[]
        } 
    },
    computed:{
        listar: function()  {
            //return this.notifications[0];
             this.arrayNotifications = Object.values(this.notifications[0]);
            if (this.notifications == '') {
                    return this.arrayNotifications = []; 
            } else {
                //Capturo la ultima notificación agregada 
                this.arrayNotifications = Object.values(this.notifications[0]); 
                //Validación por indice fuera de rango
                if (this.arrayNotifications.length > 3) { 
                    //Si el tamaño es > 3 Es cuando las notificaciones son obtenidas desde el mismo servidor, es decir por la consulta con AXIOS 
                    return Object.values(this.arrayNotifications[4]); 
                } else { 
                    //Si el tamaño es < 3 Es cuando las notificaciones son obtenidas desde el canal privado, es decir mediante Laravel Echo y Pusher 
                    return Object.values(this.arrayNotifications[0]);
                } 
            }
        }
    }
}
</script>
<style>
    .verde{
        background-color: green;
    }
    .rojo{
        background-color: red;
    }
    .badge{
      color: #fff !important;
    }
</style>