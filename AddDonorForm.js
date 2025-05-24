import { useState } from "react";
import { createDonor } from "../api";

export default function AddDonorForm() {
  const [form, setForm] = useState({
    name: "", age: "", blood_group: "",
    gender: "", email: "", phone: "", address: ""
  });
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);


  const handleSubmit = async (e) => {
    e.preventDefault();
    setLoading(true);
    setError(null);
    
    try {
      const result = await createDonor(form);
      alert(result.message);
      // Clear form after successful submission
      setForm({
        name: "", age: "", blood_group: "",
        gender: "", email: "", phone: "", address: ""
      });
    } catch (err) {
      setError(err.message);
      alert("Error: " + err.message);
    } finally {
      setLoading(false);
    }
  };

  return (
    <form onSubmit={handleSubmit}>
  <h2>Register New Donor</h2>
  {error && <div className="error">{error}</div>}
  
  <div>
    <label>Name:</label>
    <input 
      type="text" 
      value={form.name} 
      onChange={(e) => setForm({...form, name: e.target.value})} 
      required 
    />
  </div>

  <div>
    <label>Age:</label>
    <input 
      type="number" 
      value={form.age} 
      onChange={(e) => setForm({...form, age: e.target.value})}
      required
    />
  </div>

  <div>
    <label>Blood Group:</label>
    <select 
      value={form.blood_group} 
      onChange={(e) => setForm({...form, blood_group: e.target.value})}
      required
    >
      <option value="">Select</option>
      <option value="A+">A+</option>
      <option value="A-">A-</option>
      <option value="B+">B+</option>
      <option value="B-">B-</option>
      <option value="AB+">AB+</option>
      <option value="AB-">AB-</option>
      <option value="O+">O+</option>
      <option value="O-">O-</option>
    </select>
  </div>

  <div>
    <label>Gender:</label>
    <select 
      value={form.gender} 
      onChange={(e) => setForm({...form, gender: e.target.value})}
      required
    >
      <option value="">Select</option>
      <option value="Male">Male</option>
      <option value="Female">Female</option>
      <option value="Other">Other</option>
    </select>
  </div>

  <div>
    <label>Email:</label>
    <input 
      type="email" 
      value={form.email} 
      onChange={(e) => setForm({...form, email: e.target.value})}
    />
  </div>

  <div>
    <label>Phone:</label>
    <input 
      type="tel" 
      value={form.phone} 
      onChange={(e) => setForm({...form, phone: e.target.value})}
      required
    />
  </div>

  <div>
    <label>Address:</label>
    <textarea 
      value={form.address} 
      onChange={(e) => setForm({...form, address: e.target.value})}
      required
    />
  </div>

  <button type="submit" disabled={loading}>
    {loading ? "Submitting..." : "Add Donor"}
  </button>
</form>
  );
}
