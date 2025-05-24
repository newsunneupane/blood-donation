const API_URL = "http://localhost/blood_donation/api";

// Add better error handling
const handleResponse = async (response) => {
  const data = await response.json();
  if (!response.ok) {
    throw new Error(data.error || 'Request failed');
  }
  return data;
};

export const getDonors = async () => {
  const response = await fetch(`${API_URL}/get_donors.php`);
  return handleResponse(response);
};

export const createDonor = async (donor) => {
  const response = await fetch(`${API_URL}/create_donor.php`, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(donor)
  });
  return handleResponse(response);
};

// Add these missing functions
export const getDonorById = async (id) => {
  const response = await fetch(`${API_URL}/get_donor.php?id=${id}`);
  return handleResponse(response);
};

export const updateDonor = async (id, donor) => {
  const response = await fetch(`${API_URL}/update_donor.php?id=${id}`, {
    method: "PUT",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(donor)
  });
  return handleResponse(response);
};

export const deleteDonor = async (id) => {
  const response = await fetch(`${API_URL}/delete_donor.php?id=${id}`, {
    method: "DELETE"
  });
  return handleResponse(response);
};