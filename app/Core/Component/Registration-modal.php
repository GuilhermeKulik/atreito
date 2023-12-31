<div class="registration-modal">
                    <div class="card">

                        <form id="registration-form">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Digite seu nome">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Celular</label>
                                <input type="tel" class="form-control" id="phone" name="cellphone" placeholder="Digite seu celular">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input type="password" class="form-control" name="password" id="password" required>
                            </div>

                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Confirmar Senha</label>
                                <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" required>
                            </div>

                            <div class="mb-3">
                                <label for="userType" class="form-label">Tipo de usuário</label>
                                <select class="form-control" id="userType" name="userType">
                                    <option value="member">Membro</option>
                                    <option value="seller">Vendedor</option>
                                    <option value="admin">Administrador</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-login text-white">Cadastrar</button>
                        </form>
                    </div>
                </div>