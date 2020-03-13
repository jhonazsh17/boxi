<div class="row">
    <div class="col-md-12 border-first_bottom" >
        <h3>/ Sucursales - Sedes<small> / Nueva Sucursal - Sede</small></h3>
    </div>
    <div class="col-md-12 put-padding-1-top_and_bottom cont" style="height: 500px; overflow-y: auto; box-shadow: rgb(212, 212, 212) 0px 0px 8px 0px inset; background: #eeeeee3b;">
        <div class="msg-by-empty-input" style="display: none">
        <!-- div para mostrar un mensaje -->
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-9" style="padding-right: 7px">
                    <label>
                        <span class="color-red">
                            *
                        </span>
                        Nombre Sucursal/Sede:
                    </label>
                    <input class="form-control form-esp form-upper" placeholder="Ingresar Nombre de Sucursal o sede" type="text" v-model="dataSucursal.nombre">
                    </input>
                </div>
                <div class="col-md-3" style="padding-left: 7px">
                    <label>
                        Serie Facturación:
                    </label>
                    <input class="form-control form-esp form-upper" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Ingresar Serie" type="text" v-model="dataSucursal.serie">
                    </input>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6" style="padding-right: 7px">
                    <label>
                        <span class="color-red">
                            *
                        </span>
                        Dirección:
                    </label>
                    <input class="form-control form-esp form-upper" placeholder="Ingresar Dirección" type="text" v-model="dataSucursal.direccion" v-on:keyup="toUpperInForm(dataSucursal.direccion)">
                    </input>
                </div>
                <div class="col-md-6" style="padding-left: 7px">
                    <label>
                        <span class="color-red">
                            *
                        </span>
                        Lugar:
                    </label>
                    <input class="form-control form-esp form-upper" placeholder="Ingresar Lugar" type="text" v-model="dataSucursal.lugar">
                    </input>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>
                Descripción:
            </label>
            <small style="color:#969696">
                (
                <span id="cantDes">
                    0
                </span>
                / 280)
            </small>
            <textarea class="form-control form-esp form-upper" id="" maxlength="280" name="" onkeyup="getSizeCharacter(this.value.toUpperCase(), '#cantDes')" placeholder="Ingresar Descripción ..." rows="3" v-model="dataSucursal.descripcion">
            </textarea>
        </div>
        <div class="form-group supr-margin">
            <button class="btn btn-default" v-on:click="onClickGuardarSucursal()">
                <i class="fa fa-save">
                </i>
                Guardar
            </button>
            <button class="btn btn-sad margin-m1-left" v-on:click="onClickItem(3)">
                <i class="fa fa-arrow-circle-left">
                </i>
                Cancelar
            </button>
        </div>
        <input id="token-suc" name="_token" type="hidden" value="{!! csrf_token() !!}"/>

    </div>
</div>

<!-- <div class="row" style="margin-bottom: .7em">
    <div class="col-md-6">
        <b>
            Nueva Sucursal/Sede:
        </b>
    </div>
    <div class="col-md-6 text-right">
        <button class="btn btn-sad btn-sm" v-on:click="onClickItem(3)">
            <i class="fa fa-arrow-circle-left">
            </i>
            Volver
        </button>
    </div>
</div> -->
