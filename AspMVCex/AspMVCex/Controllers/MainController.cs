using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;

using AspMVCex.Models;
using AspMVCex.DataAbstractionLayer;

namespace AspMVCex.Controllers
{
    public class MainController : Controller
    {
        // GET: Main
        public ActionResult Index()
        {
            return View("LoginForm");
        }

        public string TestController()
        {
            return "Testing the MainController .. OK!";
        }



        public ActionResult GetLinks() { 
            DAL dal = new DAL();
            string username = (string)Session["username"];
            List<Link> lnks = dal.GetAllLinks(username);
            ViewData["links"] = lnks;
            return View("ViewAllLinks");
        }

        public ActionResult AddLinkForm()
        {
            return View("AddLinkForm");
         }

        public ActionResult Welcome() {

            return View("Welcome");
        }

        public ActionResult Log_In() {

   
            User user = new User();
            //user.Id = int.Parse(Request.Params["id"]);
            user.Nume = Request.Params["nume"];
            user.Password = Request.Params["password"];

            DAL dal = new DAL();
            string result = dal.Log_In(user);
            if (result != null)

            {
                Session["username"] = user.Nume;
                //Session["id"] = user.Id;
                ViewData["username"] = user.Nume;
                ViewData["id"] = user.Id;
                return View("Welcome");
            }
            return View("Error");



        }

        public ActionResult AddLink()
        {
            if (Session["username"] == null)
            {
                return View("LoginForm");
            }

            Link link = new Link();
            link.URL = Request.Params["url_link"];
            link.description = Request.Params["Description"];
            link.category = Request.Params["Category"];
            link.user = (string)Session["username"];

            DAL dal = new DAL();
            dal.SaveLink(link);
            return RedirectToAction("GetLinks");
        }


        public ActionResult DeleteLink() {
            string link_url = Request.Params["url_link"];
            DAL dal = new DAL();
            dal.DeleteLink(link_url);

            return RedirectToAction("GetLinks");
        }

        public ActionResult UpdateLink() {
            string link_url = Request.Params["url_link"];
            string descr = Request.Params["descr"];
            string category = Request.Params["category"];

            DAL dal = new DAL();
            dal.UpdateLink(link_url, descr, category);

            return RedirectToAction("GetLinks");
        }

        public ActionResult FilterLinks() {
            int page_number;
            if (Request.Params["current_page"] == null)
            {
                page_number = 1;
            }
            else
            {
                page_number = int.Parse(Request.Params["current_page"]);
            }
            Console.Write("page: " + page_number);
            string category = Request.Params["category"];
            Console.Write(category);
            string username = (string)Session["username"];
            DAL dal = new DAL();
            List<Link> lnks = dal.Filter(username, category, page_number);
            Console.Write("size\n");
            Console.Write(lnks.Capacity);
            ViewData["category"] = category;
            ViewData["links"] = lnks;
            ViewData["current_page"] = page_number;
            return View("Filtered");
        }
    }
}