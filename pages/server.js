export default function server() {
    return (
        <div>
            <h1>Server</h1>
        </div>
    )
}

// Import modul yang diperlukan
import { useState, useEffect } from 'react';
import { db } from '../lib/db'; // Pastikan ini sesuai dengan konfigurasi database Anda

export async function getServerSideProps() {
  try {
    // Mengambil data dari database
    const query = 'SELECT * FROM folders ORDER BY created_at DESC';
    const [folders] = await db.execute(query);

    return {
      props: {
        folders: JSON.parse(JSON.stringify(folders)), // Mengubah data ke format yang aman untuk props
      },
    };
  } catch (error) {
    console.error('Error mengambil data:', error);
    return {
      props: {
        folders: [],
      },
    };
  }
}

// Komponen untuk menampilkan data
export default function Server({ folders }) {
  const [data, setData] = useState(folders);

  useEffect(() => {
    // Anda bisa menambahkan logika tambahan di sini
    // Misalnya untuk memperbarui data secara real-time
  }, []);

  return (
    <div className="container mx-auto p-4">
      <h1 className="text-2xl font-bold mb-4">Data Folder</h1>
      <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
        {data.map((folder) => (
          <div key={folder.id} className="border p-4 rounded-lg shadow">
            <h2 className="text-xl font-semibold">{folder.name}</h2>
            <p className="text-gray-600">{folder.description}</p>
          </div>
        ))}
      </div>
    </div>
  );
}
