<div class="row">
    <div class="col-md-12 border-first_bottom" >
        <h3>/ Unidades de Medida <small> / Nueva Unidad de Medida</small></h3>
    </div>
    <div class="col-md-12 put-padding-1-top_and_bottom cont" style="height: 500px; overflow-y: auto; box-shadow: rgb(212, 212, 212) 0px 0px 8px 0px inset; background: #eeeeee3b;">
        <div class="row">
            <div class="col-md-12">
                <p>
                    La Nueva Unidad de Medida que se creará, servirá para la creación y gestión de productos.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="msg-by-empty-input" style="display: none">
                        <!-- div para mostrar un mensaje -->
                    </div>
                    <div class="row">
                        <div class="col-md-8" style="padding-right: 7px">
                            <label>
                                <span class="color-red">
                                    *
                                </span>
                                Nombre Unidad de Medida:
                            </label>
                            <input class="form-control form-esp form-upper" placeholder="Ingresar Nombre de Unidad de Medida" type="text" v-model="dataNuevaUnidad.nombre" onkeyup="javascript:this.value=this.value.toUpperCase();">
                            </input>
                        </div>
                        <div class="col-md-4" style="padding-left: 7px">
                            <label>
                                <span class="color-red">
                                    *
                                </span>
                                Abreviatura:
                            </label>
                            <input class="form-control form-esp form-upper" placeholder="Ingresar Abreviatura" type="text" v-model="dataNuevaUnidad.abreviatura" onkeyup="javascript:this.value=this.value.toUpperCase();">
                            </input>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-default" v-on:click="onClickGuardarUnidad()" id="guardar-nueva-unidad">
                    <i class="fa fa-save">
                    </i>
                    Guardar
                </button>
                <button class="btn btn-sad margin-m1-left" v-on:click="onClickItem(6)">
                    <i class="fa fa-arrow-circle-left">
                    </i>
                    Cancelar
                </button>
                <input id="token_unidad" name="_token" type="hidden" value="{!! csrf_token() !!}">
                </input>
            </div>
        </div>
    </div>
</div>



