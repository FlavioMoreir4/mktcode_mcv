<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{URL}}"><span>Módulos</span></a></li>
        <li class="breadcrumb-item active"><span>Depoimentos</span></li>
    </ol>
    
    {{items}}
    {{pagination}}

    <!-- Start: Basic Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="text-primary m-0 fw-bold">Enviar depoimento</h6>
        </div>
        <div class="card-body">
            <form method="post" action="?p=1">
                <div class="mb-3">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                </div>
                <div class="mb-3">
                    <label for="depoimento">Depoimento</label>
                    <textarea class="form-control" id="depoimento" name="depoimento" rows="5"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </div>
    <!-- End: Basic Card -->
</div>