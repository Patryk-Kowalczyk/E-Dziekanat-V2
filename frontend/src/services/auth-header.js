export default () => {
  //Funckja dołaczająca nagłówek autoryzujący do żądania.
  const user = JSON.parse(localStorage.getItem("user"));
  if (user && user.access_token) {
    return { Authorization: "Bearer " + user.access_token };
  } else {
    return {};
  }
};
