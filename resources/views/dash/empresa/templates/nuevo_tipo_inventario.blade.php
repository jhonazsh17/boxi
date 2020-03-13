<div class="row">
    <div class="col-md-12 border-first_bottom" >
        <h3>/ Tipos de Inventario <small> / Nuevo Tipo de Inventario</small></h3>
    </div>
    <div class="col-md-12 put-padding-1-top_and_bottom cont" style="height: 500px; overflow-y: auto; box-shadow: rgb(212, 212, 212) 0px 0px 8px 0px inset; background: #eeeeee3b;">
        <div class="row">
            <div class="col-md-12">
                <p>
                    Los Tipos de Inventario que se creen serviran para gestionar mejor cada Inventario realizado.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="msg-by-empty-input" style="display: none">
                        <!-- div para mostrar un mensaje -->
                    </div>
                    <label>
                        <span class="color-red">
                            *
                        </span>
                        Nombre Tipo de Inventario:
                    </label>
                    <input class="form-control form-esp form-upper" placeholder="Ingresar Nombre de Tipo de Inventario" type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" v-model="dataTipoInventario.nombre">
                    </input>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-default " v-on:click="onClickGuardarTipoInventario()" id="guardar-nuevo-tipo-inventario">
                    <i class="fa fa-save">
                    </i>
                    Guardar
                </button>
                <button class="btn btn-sad margin-m1-left" v-on:click="onClickItem(4)">
                    <i class="fa fa-arrow-circle-left">
                    </i>
                    Cancelar
                </button>
                <input id="token_tinv" name="_token" type="hidden" value="{!! csrf_token() !!}">
                </input>
            </div>
        </div>
    </div>
</div>


