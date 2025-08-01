SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `phone_country`, `email_verified_at`, `password`, `sales`, `team_leader`, `user_team`, `user_follow`, `is_active`, `is_archived`, `avatar_url`, `theme`, `theme_color`, `google_code`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
('1', 'Hany Darwish', 'hany.freestyle4u@gmail.com', '012 21563252', NULL, '2025-03-13 00:56:48', '$2y$12$yhdK2l4ljwgRstHn5MYtcucr6GRZqIiHlN/3q8R1UL/E8KSyuAdMm', '0', '0', NULL, NULL, '1', '0', 'admin-avatar/QGkXwHqhvuP6iPs1mj3lxj0B1nqHj3FTgfST6nWs.webp', 'default', NULL, NULL, 'atALzYTDxXAEyEWTgQuy5iR9q0B9zJwhhbcgvkIl72oCnHncQ26TLdKpDTNU', '2025-03-07 03:56:49', '2025-03-23 02:35:59', NULL),
('2', 'Eslam Darwish', 'eslam@eslam.com', '012 21563253', NULL, NULL, '$2y$12$KEhnXlGGXO6kFDhnfTcOIuiCZpHvqwMS0Sls/xeHYYycVU6.BeAZu', '0', '0', NULL, NULL, '1', '0', 'admin-avatar/uU0Ogo7Evc5AL9eBxq01RXqmXzmq1GV1203NVSJx.webp', 'default', NULL, NULL, 'UG3ntfnaVwh9F4aDNhvPxubUq68JFaUKEdA3FcNwZAEuOgcTytyU9p6JZKb8', '2025-03-12 22:48:46', '2025-03-23 02:36:42', NULL);
COMMIT;
