<div class="row">
    <div class="col-md-12 border-first_bottom" >
        <h3>/ Categorías de Productos <small> / Nueva Categoría</small></h3>
    </div>
    <div class="col-md-12 put-padding-1-top_and_bottom cont" style="height: 500px; overflow-y: auto; box-shadow: rgb(212, 212, 212) 0px 0px 8px 0px inset; background: #eeeeee3b;">
        <div class="row">
            <div class="col-md-12">
                <p>
                    La Categoría que se creará, servirá para la clasificación de los productos, según a la categoría que pertenezcan.
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
                        Nombre Categoría:
                    </label>
                    <input class="form-control form-esp form-upper" placeholder="Ingresar Nombre de Categoría" type="text" v-model="dataNuevaCategoria.nombre" onkeyup="javascript:this.value=this.value.toUpperCase();">
                    </input>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-default " v-on:click="onClickGuardarCategoria()" id="guardar-nueva-categoria">
                    <i class="fa fa-save">
                    </i>
                    Guardar
                </button>
                <button class="btn btn-sad " v-on:click="onClickItem(5)">
                    <i class="fa fa-arrow-circle-left">
                    </i>
                    Cancelar
                </button>
                <input id="token_categoria" name="_token" type="hidden" value="{!! csrf_token() !!}">
                </input>
            </div>
        </div>
    </div>
</div>



