use rusqlite::{params, Connection, Result};

fn main() -> Result<()> {
    let conn = Connection::open("test.db")?;
    conn.execute("CREATE TABLE IF NOT EXISTS person (id INTEGER PRIMARY KEY, name TEXT)", params![])?;
    conn.execute("INSERT INTO person (name) VALUES (?1)", params!["Alice"])?;
    let mut stmt = conn.prepare("SELECT id, name FROM person")?;
    let person_iter = stmt.query_map(params![], |row| {
        Ok((row.get::<_, i32>(0)?, row.get::<_, String>(1)?))
    })?;
    for person in person_iter {
        println!("Found person: {:?}", person?);
    }
    Ok(())
}
