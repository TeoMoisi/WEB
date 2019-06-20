using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

using AspMVCex.Models;
using MySql.Data.MySqlClient;

namespace AspMVCex.DataAbstractionLayer
{
    public class DAL
    {


      

        public List<Link> GetAllLinks(string username)
        {
            MySql.Data.MySqlClient.MySqlConnection conn;
            string myConnectionString;

            myConnectionString = "server=localhost;uid=root;pwd=;database=mysql;";
            List<Link> lnks = new List<Link>();

            try
            {
                conn = new MySql.Data.MySqlClient.MySqlConnection();
                conn.ConnectionString = myConnectionString;
                conn.Open();

                MySqlCommand cmd = new MySqlCommand();
                cmd.Connection = conn;
                cmd.CommandText = "select * from links where usr='" + username + "'";
                MySqlDataReader myreader = cmd.ExecuteReader();
                while (myreader.Read())
                {
                    Link link = new Link();
                    link.URL = myreader.GetString("URL");
                    link.description = myreader.GetString("description");
                    link.category = myreader.GetString("category");
                    link.user = myreader.GetString("usr");
                    lnks.Add(link);

                }
                myreader.Close();
            }
            catch (MySql.Data.MySqlClient.MySqlException ex)
            {
                Console.Write(ex.Message);
            }
            return lnks;

        }


        public List<Link> Filter(string username, string category, int page_number)
        {
            MySql.Data.MySqlClient.MySqlConnection conn;
            string myConnectionString;

            myConnectionString = "server=localhost;uid=root;pwd=;database=mysql;";
            List<Link> lnks = new List<Link>();

            int limit = 3;
            int offset = (page_number - 1) * limit;
            Console.Write("Offset:" + offset);
            try
            {
                conn = new MySql.Data.MySqlClient.MySqlConnection();
                conn.ConnectionString = myConnectionString;
                conn.Open();

                MySqlCommand cmd = new MySqlCommand();
                cmd.Connection = conn;
                cmd.CommandText = "select * from links where usr='" + username + "' and category='" + category + "' limit 3 offset " + offset.ToString();
                MySqlDataReader myreader = cmd.ExecuteReader();
                while (myreader.Read())
                {
                    Link link = new Link();
                    link.URL = myreader.GetString("URL");
                    link.description = myreader.GetString("description");
                    link.category = myreader.GetString("category");
                    link.user = myreader.GetString("usr");
                    lnks.Add(link);

                }
                myreader.Close();
            }
            catch (MySql.Data.MySqlClient.MySqlException ex)
            {
                Console.Write(ex.Message);
            }
            return lnks;

        }


        public void SaveLink(Link link)
        {
            MySql.Data.MySqlClient.MySqlConnection conn;
            string myConnectionString;

            myConnectionString = "server=localhost;uid=root;pwd=;database=mysql;";

            try
            {
                conn = new MySql.Data.MySqlClient.MySqlConnection();
                conn.ConnectionString = myConnectionString;
                conn.Open();

                MySqlCommand cmd = new MySqlCommand();
                cmd.Connection = conn;
                cmd.CommandText = "INSERT INTO `links`(`URL`, `description`, `category`, `usr`) values('" + link.URL + "','" + link.description + "','" + link.category + "','" + link.user + "')";
                cmd.ExecuteNonQuery();

            }
            catch (MySql.Data.MySqlClient.MySqlException ex)
            {
                Console.Write(ex.Message);
            }

        }

        public void DeleteLink(string url_link) {

            MySql.Data.MySqlClient.MySqlConnection conn;
            string myConnectionString;

            myConnectionString = "server=localhost;uid=root;pwd=;database=mysql;";

            try
            {
                conn = new MySql.Data.MySqlClient.MySqlConnection();
                conn.ConnectionString = myConnectionString;
                conn.Open();

                MySqlCommand cmd = new MySqlCommand();
                cmd.Connection = conn;
                cmd.CommandText = "DELETE FROM links where URL='" +url_link + "'";
                cmd.ExecuteNonQuery();

            }
            catch (MySql.Data.MySqlClient.MySqlException ex)
            {
                Console.Write(ex.Message);
            }
        }


        public void UpdateLink(string url_link, string descr, string category)
        {

            MySql.Data.MySqlClient.MySqlConnection conn;
            string myConnectionString;

            myConnectionString = "server=localhost;uid=root;pwd=;database=mysql;";

            try
            {
                conn = new MySql.Data.MySqlClient.MySqlConnection();
                conn.ConnectionString = myConnectionString;
                conn.Open();

                MySqlCommand cmd = new MySqlCommand();
                cmd.Connection = conn;
                cmd.CommandText = "UPDATE links SET description='" + descr + "', category='" + category + "' where URL='" + url_link + "'";
                cmd.ExecuteNonQuery();

            }
            catch (MySql.Data.MySqlClient.MySqlException ex)
            {
                Console.Write(ex.Message);
            }
        }

        public string Log_In(User user) {

            string result = null;

            MySql.Data.MySqlClient.MySqlConnection conn;
            string myConnectionString;

            myConnectionString = "server=localhost;uid=root;pwd=;database=web;";

            try
            {
                conn = new MySql.Data.MySqlClient.MySqlConnection();
                conn.ConnectionString = myConnectionString;
                conn.Open();


                MySqlCommand cmd = new MySqlCommand();
                cmd.Connection = conn;cmd.CommandText = "select * from users";
                MySqlDataReader myreader = cmd.ExecuteReader();

                while (myreader.Read()) { 
                    if (myreader.GetString("password") == user.Password && myreader.GetString("name") == user.Nume) {
                        result = user.Nume;
                    }
                    else {

                        result = null;
                     }
                }

            }
            catch (MySql.Data.MySqlClient.MySqlException ex)
            {
                Console.Write(ex.Message);
            }

            return result;

        }

    }
}