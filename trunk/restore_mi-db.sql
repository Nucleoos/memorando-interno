################################
######INSERÇÃO DE UNIDADE#######
################################

INSERT INTO `unidade`(`idUnidade`, `nome`) VALUES ('1',"Diretoria da Faculdade de Computação");

INSERT INTO `unidade`(`idUnidade`, `nome`) VALUES ('2',"Secretaria da Faculdade de Computação");

INSERT INTO `unidade`(`idUnidade`, `nome`) VALUES ('3',"Colegiado do Curso de Bacharelado em Sistemas de Informação");

INSERT INTO `unidade`(`idUnidade`, `nome`) VALUES ('4',"Colegiado do Curso de Bacharelado em Ciências da Computação");

INSERT INTO `unidade`(`idUnidade`, `nome`) VALUES ('5',"Conselho da Faculdade de Computação");

INSERT INTO `unidade`(`idUnidade`, `nome`) VALUES ('6',"Coordenação do Curso de Bacharelado em Sistemas de Informação");

INSERT INTO `unidade`(`idUnidade`, `nome`) VALUES ('7',"Coordenação do Curso de Bacharelado em Ciências da Computação");

INSERT INTO `unidade`(`idUnidade`, `nome`) VALUES ('8',"PET - Sistemas de Informação");

INSERT INTO `unidade`(`idUnidade`, `nome`) VALUES ('9',"PET - Ciência da Computação");

INSERT INTO `unidade`(`idUnidade`, `nome`) VALUES ('10',"Professor");

#################################
#######INSERÇÃO DE USUÁRIO#######
#################################

INSERT INTO `usuario`(`idUsuario`, `nome`, `titulo`, `cargo`, `permissaoSistema`, `emailInstitucional`, `senha`) VALUES ('00001',"Son Goku","Dr.","Petiano","admin","songoku@facom.ufu.br","songoku");

INSERT INTO `usuario`(`idUsuario`, `nome`, `titulo`, `cargo`, `permissaoSistema`, `emailInstitucional`, `senha`) VALUES ("00002","Insector Sun","Mestre","Coordenador do Curso de Sistemas de Informação","user","insectorsun@facom.ufu.br","insectorsun");

##################################
##RELACIONAMENTO USUÁRIO/UNIDADE##
##################################

INSERT INTO `usuario_has_unidade`(`idUsuario`, `idUnidade`) VALUES ('00001',"1");

INSERT INTO `usuario_has_unidade`(`idUsuario`, `idUnidade`) VALUES ('00001',"6");

INSERT INTO `usuario_has_unidade`(`idUsuario`, `idUnidade`) VALUES ('00001',"8");

INSERT INTO `usuario_has_unidade`(`idUsuario`, `idUnidade`) VALUES ('00001',"10");

INSERT INTO `usuario_has_unidade`(`idUsuario`, `idUnidade`) VALUES ('00002',"4");

INSERT INTO `usuario_has_unidade`(`idUsuario`, `idUnidade`) VALUES ('00002',"9");

INSERT INTO `usuario_has_unidade`(`idUsuario`, `idUnidade`) VALUES ('00002',"6");



