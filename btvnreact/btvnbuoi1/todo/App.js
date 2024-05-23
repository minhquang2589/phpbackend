import logo from './logo.svg';
import './App.css';
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.bundle.min";
import Footer from './layout/footer.jsx'; 
import Header  from './layout/header.jsx';
import Main  from './layout/main.jsx';


function App() {
  return (
    <div className="container">
      <Header />
      <Main />
      <Footer /> 
    </div>
  );
}

export default App;
