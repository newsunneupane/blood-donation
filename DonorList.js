import { useEffect, useState } from "react";
import { getDonors } from "../api";

export default function DonorList() {
  const [donors, setDonors] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchDonors = async () => {
      try {
        const data = await getDonors();
        setDonors(data);
      } catch (err) {
        setError(err.message);
      } finally {
        setLoading(false);
      }
    };

    fetchDonors();
  }, []);

  if (loading) return <div>Loading...</div>;
  if (error) return <div>Error: {error}</div>;

  return (
    <div>
      <h2>Donor List</h2>
      <ul>
        {donors.map((donor) => (
          <li key={donor.id}>
            {donor.name} - {donor.blood_group} - {donor.phone}
          </li>
        ))}
      </ul>
    </div>
  );
}