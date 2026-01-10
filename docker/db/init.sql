
DROP TABLE IF EXISTS stock_price_history CASCADE;
DROP TABLE IF EXISTS transactions CASCADE;
DROP TABLE IF EXISTS portfolio CASCADE;
DROP TABLE IF EXISTS stocks CASCADE;
DROP TABLE IF EXISTS users CASCADE;


CREATE TABLE users (
                       id SERIAL PRIMARY KEY,
                       username VARCHAR(50) NOT NULL UNIQUE,
                       email VARCHAR(100) NOT NULL UNIQUE,
                       password_hash VARCHAR(255) NOT NULL,
                       cash NUMERIC(12,2) NOT NULL DEFAULT 10000,
                       created_at TIMESTAMP DEFAULT NOW()
);


CREATE TABLE stocks (
                        id SERIAL PRIMARY KEY,
                        symbol VARCHAR(10) NOT NULL UNIQUE,
                        name VARCHAR(100) NOT NULL,
                        price NUMERIC(12,2) NOT NULL,
                        price_updated_at TIMESTAMP NOT NULL DEFAULT NOW()
);


CREATE TABLE portfolio (
                           user_id INT NOT NULL,
                           stock_id INT NOT NULL,
                           quantity NUMERIC(12,4) NOT NULL,
                           PRIMARY KEY (user_id, stock_id),

                           CONSTRAINT fk_portfolio_user
                               FOREIGN KEY (user_id)
                                   REFERENCES users(id)
                                   ON DELETE CASCADE,

                           CONSTRAINT fk_portfolio_stock
                               FOREIGN KEY (stock_id)
                                   REFERENCES stocks(id)
                                   ON DELETE CASCADE
);


CREATE TABLE transactions (
                              id SERIAL PRIMARY KEY,
                              user_id INT NOT NULL,
                              stock_id INT NOT NULL,
                              type VARCHAR(4) NOT NULL CHECK (type IN ('BUY','SELL')),
                              quantity NUMERIC(12,4) NOT NULL,
                              price NUMERIC(12,2) NOT NULL,
                              created_at TIMESTAMP DEFAULT NOW(),

                              CONSTRAINT fk_transaction_user
                                  FOREIGN KEY (user_id)
                                      REFERENCES users(id)
                                      ON DELETE CASCADE,

                              CONSTRAINT fk_transaction_stock
                                  FOREIGN KEY (stock_id)
                                      REFERENCES stocks(id)
                                      ON DELETE CASCADE
);


CREATE TABLE stock_price_history (
                                     id SERIAL PRIMARY KEY,
                                     stock_id INT NOT NULL,
                                     price NUMERIC(12,2) NOT NULL,
                                     created_at TIMESTAMP NOT NULL DEFAULT NOW(),

                                     CONSTRAINT fk_history_stock
                                         FOREIGN KEY (stock_id)
                                             REFERENCES stocks(id)
                                             ON DELETE CASCADE
);


INSERT INTO users (username, email, password_hash) VALUES
                                                       (
                                                           'alice',
                                                           'alice@test.com',
                                                           '$2y$10$Zy8kz8pCzZ8XhZlZtY6n6eN7rJ6A6m9q0cZkQe9E0u6zXxQX5aWcG'
                                                       ),
                                                       (
                                                           'bob',
                                                           'bob@test.com',
                                                           '$2y$10$Zy8kz8pCzZ8XhZlZtY6n6eN7rJ6A6m9q0cZkQe9E0u6zXxQX5aWcG'
                                                       );

INSERT INTO stocks (symbol, name, price) VALUES
                                             ('BTC', 'Bitcoin', 40000),
                                             ('ETH', 'Ethereum', 2200),
                                             ('AAPL', 'Apple Inc.', 180),
                                             ('TSLA', 'Tesla Inc.', 250);


INSERT INTO stock_price_history (stock_id, price)
SELECT id, price FROM stocks;

CREATE TABLE user_portfolio_snapshots (
                                          id SERIAL PRIMARY KEY,
                                          user_id INT NOT NULL,
                                          total_value NUMERIC(12,2) NOT NULL,
                                          created_at TIMESTAMP NOT NULL DEFAULT NOW(),

                                          CONSTRAINT fk_snapshot_user
                                              FOREIGN KEY (user_id)
                                                  REFERENCES users(id)
                                                  ON DELETE CASCADE
);

INSERT INTO user_portfolio_snapshots (user_id, total_value)
SELECT id, cash FROM users;
