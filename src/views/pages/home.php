<?php $render('header'); ?>

    <div class="body-home">
        <div class="container">
            <?php if(isset($address['notExists']) && $address['notExists'] == true):?>
            <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                o cep que você procurou não foi encontrado, ou não existe!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>
            <?php if(isset($address['cepInvalid']) && $address['cepInvalid'] == true):?>
            <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                cep inválido, por favor digite apenas 8 números!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>
            <form class="d-flex justify-content-center" method="POST">
                <input style="border:#999 solid;" class="search-cep form-control me-2" name="cep" type="search" placeholder="Digite o CEP..." aria-label="Search">
                <button class="btn btn-success" type="submit">Buscar</button>
            </form>
            <div class="list-address row justify-content-center">
                <div class="col-8">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>CEP</th>
                                <th>Endereço</th>
                                <th>Bairro</th>
                                <th>Cidade</th>
                                <th>UF</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="teste">
                                <td><?php if(isset($address['cep'])){print_r($address['cep']);}else{echo " - ";}?></td>
                                <td><?php if(isset($address['logradouro'])){print_r($address['logradouro']);}else{echo " - ";}?></td>
                                <td><?php if(isset($address['bairro'])){print_r($address['bairro']);}else{echo " - ";}?></td>
                                <td><?php if(isset($address['localidade'])){print_r($address['localidade']);}else{echo " - ";}?></td>
                                <td><?php if(isset($address['uf'])){print_r($address['uf']);}else{echo " - ";}?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row text-center mb-4 mt-4">
                    <div>
                        <a <?php if(!isset($address['map'])){echo "hidden";}?> class="btn btn-primary" href="https://www.google.com/maps/place/<?=$address['map']?>" target="_blank">Seu endereço no Google Maps</a>
                    </div>
                </div>
            </div>
            <?php if(!isset($address['cep'])):?>
            <div class="alert alert-primary text-center" role="alert">
                Ainda não pesquisou?? Localize o endereço pelo cep!
            </div>
            <?php endif;?>
        </div>
    </div>
<?php $render('footer'); ?>