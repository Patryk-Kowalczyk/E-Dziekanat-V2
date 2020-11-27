export default () => {
  //Funckja dołaczająca nagłówek autoryzujący do żądania.
  const user = JSON.parse(localStorage.getItem("user"));

  if (user && user.accessToken) {
    return { Authorizaiton: "Bearer " + user.accessToken };
  } else {
    return {};
  }
};
