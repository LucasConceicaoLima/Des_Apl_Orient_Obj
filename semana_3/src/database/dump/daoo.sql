-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27-Dez-2023 às 12:22
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `daoo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `descontos`
--

CREATE TABLE `descontos` (
  `id_desc` bigint(20) UNSIGNED NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `taxa` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `descontos`
--

INSERT INTO `descontos` (`id_desc`, `descricao`, `taxa`) VALUES
(5, 'Black Friday', '20.00'),
(6, 'Cyber Monday', '15.00'),
(7, 'Natal', '25.00'),
(8, 'Ano Novo', '22.00'),
(9, 'Carnaval', '10.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `extras`
--

CREATE TABLE `extras` (
  `id_ext` bigint(20) UNSIGNED NOT NULL,
  `descricao` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `extras`
--

INSERT INTO `extras` (`id_ext`, `descricao`) VALUES
(1, 'cumque'),
(2, 'accusamus'),
(3, 'veniam'),
(4, 'sint');

-- --------------------------------------------------------

--
-- Estrutura da tabela `postagem`
--

CREATE TABLE `postagem` (
  `titulo` varchar(50) NOT NULL,
  `conteudo` text NOT NULL,
  `data_postagem` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `postagem`
--

INSERT INTO `postagem` (`titulo`, `conteudo`, `data_postagem`) VALUES
('Teste titulo', 'Teste conteúdo 123abc Lorem ipsum', '2023-09-02 14:36:11');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id_prod` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(200) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `qtd_estoque` int(11) NOT NULL DEFAULT 0,
  `preco` decimal(10,2) NOT NULL,
  `importado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id_prod`, `nome`, `descricao`, `qtd_estoque`, `preco`, `importado`) VALUES
(111, 'Samsumg A5 - 2017', 'Samsumg A5 2017 2GB Exynos 8Core', 2, '4500.00', 0),
(112, 'Notebook DELL Inspiron 15', 'I5 7600HQ 8GBMen GTX1030m SSD 1TB', 300, '8500.00', 0),
(113, 'Notebook Samsumg Gamer', 'I7 10800HQ 16GB MEM NVIDIA-RTX2060m SSD 2TB', 150, '17500.00', 0),
(114, 'SSD 4TB', 'SSD SAMSUMG EVO 860 4TB', 200, '5750.00', 0),
(115, 'SSD 2TB', 'SSD SAMSUMG EVO 860 2TB', 150, '3750.00', 0),
(121, 'SSD 4TB', 'SSD WESTERN DIGITAL', 50, '4150.00', 0),
(122, 'GAINWARD PHOENIX RTX3080ti', 'GPU NVIDIA 12GB MEM GDDR6 256BITS GAINWARD PHOENIX ', 30, '14150.00', 0),
(123, 'GAINWARD PHOENIX RTX3070', 'GPU NVIDIA 8GB MEM GDDR6 256BITS GAINWARD PHOENIX ', 60, '7399.00', 0),
(124, 'ECHO DOT ALEXA', 'AMAZON ALEX ECHO DOT 3 GEN SMART SPEAKER', 1000, '200.00', 0),
(125, 'Monitor Asus BK 35\'\'', 'LED 35\" 3440x1440 Preto 1 HDMI(v1.4)', 500, '9990.00', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `prod_desc`
--

CREATE TABLE `prod_desc` (
  `id_prod` bigint(20) UNSIGNED NOT NULL,
  `id_desc` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `prod_desc`
--

INSERT INTO `prod_desc` (`id_prod`, `id_desc`) VALUES
(121, 7),
(122, 5),
(123, 5),
(123, 7),
(123, 9),
(124, 6),
(124, 7),
(124, 8),
(125, 5),
(125, 7),
(125, 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `prod_ext`
--

CREATE TABLE `prod_ext` (
  `id_prod` bigint(20) UNSIGNED NOT NULL,
  `id_ext` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `title` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tags`
--

INSERT INTO `tags` (`id`, `title`) VALUES
(1, 'Notícias'),
(2, 'Tecnologia'),
(3, 'Saúde');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(35) NOT NULL,
  `senha` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `nome`, `email`, `senha`) VALUES
(1, 'User insert editado novo', 'teste@teste.com', '1212');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `descontos`
--
ALTER TABLE `descontos`
  ADD PRIMARY KEY (`id_desc`);

--
-- Índices para tabela `extras`
--
ALTER TABLE `extras`
  ADD PRIMARY KEY (`id_ext`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id_prod`);

--
-- Índices para tabela `prod_desc`
--
ALTER TABLE `prod_desc`
  ADD PRIMARY KEY (`id_prod`,`id_desc`),
  ADD KEY `id_desc` (`id_desc`);

--
-- Índices para tabela `prod_ext`
--
ALTER TABLE `prod_ext`
  ADD PRIMARY KEY (`id_prod`,`id_ext`),
  ADD KEY `id_ext` (`id_ext`);

--
-- Índices para tabela `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `descontos`
--
ALTER TABLE `descontos`
  MODIFY `id_desc` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `extras`
--
ALTER TABLE `extras`
  MODIFY `id_ext` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_prod` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT de tabela `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `prod_desc`
--
ALTER TABLE `prod_desc`
  ADD CONSTRAINT `prod_desc_ibfk_1` FOREIGN KEY (`id_prod`) REFERENCES `produtos` (`id_prod`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prod_desc_ibfk_2` FOREIGN KEY (`id_desc`) REFERENCES `descontos` (`id_desc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `prod_ext`
--
ALTER TABLE `prod_ext`
  ADD CONSTRAINT `prod_ext_ibfk_1` FOREIGN KEY (`id_prod`) REFERENCES `produtos` (`id_prod`),
  ADD CONSTRAINT `prod_ext_ibfk_2` FOREIGN KEY (`id_ext`) REFERENCES `extras` (`id_ext`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
