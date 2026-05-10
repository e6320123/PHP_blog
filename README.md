# PHP Blog 部落格系統

一個使用 PHP + MySQL 開發的基礎部落格系統，具備完整的使用者認證與文章管理功能。

## 功能

- 使用者註冊 / 登入 / 登出
- 密碼使用 password_hash() 加密儲存
- 發布、編輯、刪除文章
- 登入狀態驗證（Session 管理）
- PDO 參數化查詢（防止 SQL Injection）

## 技術

- PHP
- MySQL
- PDO
- Session

## 資料庫結構

**users 資料表**
- id、username、email、password、created_at

**posts 資料表**
- id、user_id、title、content、created_at

## 開發說明

使用 AI 協作開發，技術選擇與功能邏輯能獨立說明。
