import sqlite3

def create_database():
    conn = sqlite3.connect('trading_card_game.db')
    c = conn.cursor()

    # Create users table
    c.execute('''
    CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT NOT NULL UNIQUE,
        password TEXT NOT NULL,
        role TEXT NOT NULL CHECK (role IN ('user', 'premium', 'admin'))
    )
    ''')

    # Create cards table
    c.execute('''
    CREATE TABLE IF NOT EXISTS cards (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        attack INTEGER NOT NULL,
        defense INTEGER NOT NULL,
        set_name TEXT NOT NULL,
        rarity TEXT NOT NULL,
        price REAL NOT NULL
    )
    ''')

    # Create decks table
    c.execute('''
    CREATE TABLE IF NOT EXISTS decks (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user_id INTEGER NOT NULL,
        name TEXT NOT NULL,
        FOREIGN KEY (user_id) REFERENCES users(id)
    )
    ''')

    # Create deck_cards table
    c.execute('''
    CREATE TABLE IF NOT EXISTS deck_cards (
        deck_id INTEGER NOT NULL,
        card_id INTEGER NOT NULL,
        count INTEGER NOT NULL,
        PRIMARY KEY (deck_id, card_id),
        FOREIGN KEY (deck_id) REFERENCES decks(id),
        FOREIGN KEY (card_id) REFERENCES cards(id)
    )
    ''')

    conn.commit()
    conn.close()

if __name__ == '__main__':
    create_database()
