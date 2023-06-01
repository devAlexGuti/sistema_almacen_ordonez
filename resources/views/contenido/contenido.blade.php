    @extends('principal')
    @section('contenido')

<!-- si idrol es igual 1, accede a esos modulos -->
    @if(Auth::check())
            @if (Auth::user()->idrol == 1)
            <template v-if="menu==0">
                <dashboard></dashboard>
            </template>
<!-- template es un etiqueta que no se puede ver, que laravel proporciona, sirve para usar en condiciones -->
            <!-- si menu es igual a 1, que me acceda al modulo categoria -->
            <!-- le mostrará la ventana categoria -->
            <template v-if="menu==1">
                <categoria></categoria>
            </template>

<!-- si menu es igual a 2, que me acceda al modulo producto -->
            <template v-if="menu==2">
                <producto></producto>
            </template>

<!-- si menu es igual a 3, que me acceda al modulo compra-->
            <template v-if="menu==3">
                <compra></compra>
            </template>

<!-- si menu es igual a 4, que me acceda al modulo proveedor -->
            <template v-if="menu==4">
                <proveedor></proveedor>
            </template>

<!-- si menu es igual a 5, que me acceda al modulo venta -->
            <template v-if="menu==5">
                <venta></venta>
            </template>

<!-- si menu es igual a 15, que me acceda al modulo pedido -->
            <template v-if="menu==15">
                <pedido></pedido>
            </template>

            <template v-if="menu==6">
                <cliente></cliente>
            </template>

            <template v-if="menu==7">
                <user></user>
            </template>

            <template v-if="menu==8">
                <rol></rol>
            </template>

            <template v-if="menu==9">
                <consultacompra></consultacompra>
            </template>

            <template v-if="menu==10">
                <consultapedido></consultapedido>
            </template>

            <template v-if="menu==16">
                <consultaventa></consultaventa>
            </template>

            <template v-if="menu==11">
                <reporteindicador1></reporteindicador1>
            </template>

            <template v-if="menu==12">
                <reporteindicador2></reporteindicador2>
            </template>

            <template v-if="menu==13">
                <entregaperfecta_pretest></entregaperfecta_pretest>
            </template>

            <template v-if="menu==14">
                <entregastiempo_pretest></entregastiempo_pretest>
            </template>

            <template v-if="menu==17">
                <despacho></despacho>
            </template>
            
            @elseif (Auth::user()->idrol == 2)
            <template v-if="menu==0">
                <dashboard></dashboard>
            </template>
            <template v-if="menu==5">
                <venta></venta>
            </template>

            <template v-if="menu==6">
                <cliente></cliente>
            </template>

            <template v-if="menu==17">
                <despacho></despacho>
            </template>

            <template v-if="menu==10">
                <consultapedido></consultapedido>
            </template>

            <template v-if="menu==16">
                <consultaventa></consultaventa>
            </template>

            <template v-if="menu==11">
                <h1>Ayuda</h1>
            </template>

            <template v-if="menu==12">
                <h1>Acerca de</h1>
            </template>
            @elseif (Auth::user()->idrol == 3)
            <template v-if="menu==0">
                <dashboard></dashboard>
            </template>
            <template v-if="menu==1">
                <categoria></categoria>
            </template>

            <template v-if="menu==2">
                <producto></producto>
            </template>

            <template v-if="menu==3">
                <compra></compra>
            </template>

            <template v-if="menu==4">
                <proveedor></proveedor>
            </template>
            <template v-if="menu==9">
                <consultacompra></consultacompra>
            </template>
            <template v-if="menu==10">
                <consultapedido></consultapedido>
            </template>
            <template v-if="menu==15">
                <pedido></pedido>
            </template>
            @else
                <template>
                    <despacho></despacho>
                </template>
            @endif

    @endif
       
        
    @endsection